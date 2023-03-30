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
    const browser = await puppeteer.launch({
      javascriptEnabled: true,
      executablePath: this.getExecutablePath(),
      args,
    });

    try {
      const page = await browser.newPage();
      await page.goto(url);
      await this.wait(this.getWaitSeconds());
      await page.close();
      const html = await this.page.content();
      await browser.close();

      return html;
    } catch (error) {
      await browser.close();

      return "";
    }
  }

  /**
   * @param {number} seconds
   *
   * @returns {void}
   */
  async wait(seconds) {
    return new Promise((resolve) => setTimeout(resolve, seconds * 1000));
  }
}

(async () => {
  try {
    const crawler = new Crawler();
    const [, executablePath, waitSeconds, userAgent, url] = process.argv.slice(1);

    if (executablePath) {
      crawler.setExecutablePath(executablePath);
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
})();
