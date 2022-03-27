<?php

namespace App\Traits;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

trait Selenium
{

  protected $driver;

  /** 
   * @var serverUrl Browser Session
   *  
   * */

  protected $serverUrl = 'http://localhost:4444/wd/hub';


  public function createDriver()
  {

    logger('in create driver');
    $options = new ChromeOptions();
    $options->addArguments(['--no-sandbox', '--disable-dev-shm-usage', "--ignore-certificate-errors", "--ignore-ssl-errors", "--start-maximized",'--disable-single-click-autofill', '--headless', '--user-agent=' . $this->getUserAgent()]);
    $caps = DesiredCapabilities::chrome();
    $caps->setCapability(ChromeOptions::CAPABILITY, $options);
    $this->driver = RemoteWebDriver::create($this->serverUrl, $caps, 60000, 60000);
    logger('end create');
    return $this->driver;
  }

  public function type($field, $input)
  {
    $text_split = preg_split('//u', $input, -1, PREG_SPLIT_NO_EMPTY);

    $field->click();

    foreach ($text_split as $text_char) {
      $field->sendKeys($text_char);
      usleep(rand(50000, 100000));
    }
  }


  public function getUserAgent()
  {
    // Get the contents of the JSON file 
    $file = file_get_contents(public_path("user-agents.json"));

    // Convert to array 
    $user_agents = json_decode($file, true);

    return $user_agents[rand(0, count($user_agents) - 1)]['useragent'];
  }
}
