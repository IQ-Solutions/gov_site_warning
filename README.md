# Government Site Warning Modal Module
Module that displays a customizable government site warning popup.

## Installation
Preferred installation is through composer.

1. Open the project composer.json file
2. Go to the repositories section
3. Paste the following code (following the syntax in the section)
```
{
  "type": "git",
  "url": "git@github.com:IQ-Solutions/gov_site_warning.git"
}
```
4. Add the module to composer: `composer require iq/gov_site_warning`

_**NOTE About Github Auth Token**: Installing via composer will require you add a Github auth token on your local AND in whatever build process you have. Feel free to reach out and ask questions about this if you are unsure how to do this._

_**NOTE ABOUT GITIGNORE**: You should add the module folder to the .gitignore file._
## Configuration
Once installed you will need to check the configuration. Default warning language is included but since this may change per project, the value is configurable.

### From the Drupal admin menu
1. Go to **Configuration** > **Warning Banner Config**
2. Change the text as necessary
3. Make sure it is enabled