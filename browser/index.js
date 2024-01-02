const puppeteer = require("puppeteer");

class Crawler {

  constructor() {
    /**
     * @type {string}
     */
    this.executablePath = "/usr/bin/chromium";

    /**
     * @type {number}
     */
    this.connectTimeout = 5;

    /**
     * @type {number}
     */
    this.waitSeconds = 5;
  }

  /**
   * @param {string} executablePath
   *
   * @returns {void}
   */
  setExecutablePath(executablePath) {
    this.executablePath = executablePath;
  }

  /**
   * @returns {string}
   */
  getExecutablePath() {
    return this.executablePath;
  }

  /**
   * @param {number} connectTimeout
   *
   * @returns {void}
   */
  setConnectionTimeout(connectTimeout) {
    this.connectTimeout = connectTimeout;
  }

  /**
   * @returns {number}
   */
  getConnectionTimeout() {
    return this.connectTimeout;
  }

  /**
   * @param {number} waitSeconds
   *
   * @returns {void}
   */
  setWaitSeconds(waitSeconds) {
    this.waitSeconds = waitSeconds;
  }

  /**
   * @returns {number}
   */
  getWaitSeconds() {
    return this.waitSeconds;
  }

  /**
   * @param {string} userAgent
   *
   * @returns {void}
   */
  setUserAgent(userAgent) {
    this.userAgent = userAgent;
  }

  /**
   * @returns {string}
   */
  getUserAgent() {
    return this.userAgent;
  }

  /**
   * @param {string} url
   *
   * @returns {string}
   */
  async execute(url) {
    const args = [
      "--no-sandbox",
      "--disable-setuid-sandbox",
    ];
    const userAgent = this.getUserAgent();
    if (userAgent) {
      args.push(`--user-agent=${userAgent}`);
    }
    const browser = await Promise.race([
      puppeteer.launch({
        javascriptEnabled: true,
        executablePath: this.getExecutablePath(),
        args,
      }),
      await this.timeout(this.getConnectionTimeout()),
    ]);
    const page = await browser.newPage();
    await page.goto(url);
    await this.timeout(this.getWaitSeconds());
    const html = await page.content();
    await page.close();
    await browser.close();

    return html;
  }

  /**
   * @param {number} seconds
   *
   * @returns {Promise<void>}
   */
  async timeout(seconds) {
    return new Promise((resolve) => setTimeout(resolve, seconds * 1000));
  }
}

(async () => {
  try {
    const crawler = new Crawler();
    const [, executablePath, connectionTimeout, waitSeconds, userAgent, url] = process.argv.slice(1);
    if (executablePath) {
      crawler.setExecutablePath(executablePath);
    }

    if (connectionTimeout) {
      crawler.setConnectionTimeout(connectionTimeout);
    }

    if (waitSeconds) {
      crawler.setWaitSeconds(waitSeconds);
    }

    if (userAgent) {
      crawler.setUserAgent(userAgent);
    }

    console.log(JSON.stringify({
      html: await crawler.execute(url),
    }));
  } catch (error) {
    console.log(error.message);
  }

  process.exit(1);
})();
