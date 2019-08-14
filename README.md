## IRMA demo pages

This project is the combination of all demos hosted on https://privacybydesign.foundation/demo/.

### Install
* Run `yarn install`
* Set IRMA server URL and API token of the IRMA server of your choice in `config.php`.
* Run ./build_artifacts.sh

### Adding a new demo
Example when adding a demo called new-demo:
* Make a new demo directory in the project root: `mkdir new-demo`
* Construct at least an `index.{lang}.html` per language, take into account the following:
   * For example, the file for Dutch is called `index.nl.html` and for english `index.en.html`. 
   * When needing a library (css or javascript), you need to refer to the libraries in the `/assets` directory. When the assets directory is not present, make sure you have run `./build_artifacts`.
   * When needing a new library, make sure to add the dependency in `package.json` and re-run `yarn install`. You also need to add an extra copy rule in `./build-artifacts` to copy the dependency from `node_modules` to `assets` and ru-run this script.
   * IRMA sessions can be started using `start_session(type, lang, success_fun, cancelled_fun, error_fun)`.
   Make sure the session request of type `type` is added to `start_session.php`. The `lang` parameter should be set to 
   `en` or `nl` depending on the desired language. `success_fun(session_result)` is the function that is going to be executed when the
   session is finished successfully. `cancelled_fun` is executed when the session is cancelled and `error_fun(error_message)` is
   called when an error occurs during the IRMA session.
        * Start session must be imported from `start_session.js`. The easiest way to do this is wrapping its call in
        `$.getScript("../start_session.js", function() { ... })`. For this, jquery and irmajs are needed as dependencies.
* When adding separate Javascript files. please separate the visible strings from the rest of the code and put those in `messages.en.js` and `messages.nl.js` depending on the languange of the string.
* Make sure you never edit the source files in `/build`, because these files get overwritten.
        
Alternatively, you could just copy and alter an existing demo.
