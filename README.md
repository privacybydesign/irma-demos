## IRMA demo pages

This project is the combination of all demos hosted on https://privacybydesign.foundation/demo/.

### Install
* Run `php composer.phar install` in the project root.
    * When the vendor folder is already hosted elsewhere, this step can be omitted. The vendor path in `config.php`
    should be updated then. 
* Set file locations of the javascript and css libraries in `config.js`. By default the libraries from `/assets` are
used. When the libraries are already hosted elsewhere and the links are updated in `config.js`, the assets folder 
can be removed.
* Set IRMA server URL and API token of the IRMA server of your choice in `config.php`.

### Adding a new demo
Example when adding a demo called new-demo:
* Make a new demo directory in the project root: `mkdir new-demo`
* Make a dutch and an english version of the demo:
    ```
    cd new-demo
    mkdir en nl
    ```
* Construct at least an `index.html` per language, take into account the following:
    * When needing a library (css or javascript): make sure to load it via `config.js`.
    For example, when needing jquery and bootstrap:
        ```
        <script id="jquery"></script>
        <link id="bootstrap" rel="stylesheet"/>
        <script src="../../config.js" defer></script>
        ```
        When needing a new library, the library's id should be added to `config.js`. This in order to be
        able to configure the library's location when building.
        
   * When using other javascript that depends on libraries, make sure the execution is paused until the libraries are
    loaded. This can be done by wrapping the function in `waitUntilLibrariesLoaded(functionToWrap)`.
   * IRMA sessions can be started using `start_session(type, lang, success_fun, cancelled_fun, error_fun)`.
   Make sure the session request of type `type` is added to `start_session.php`. The `lang` parameter should be set to 
   `en` or `nl` depending on the desired language. `success_fun(session_result)` is the function that is going to be executed when the
   session is finished successfully. `cancelled_fun` is executed when the session is cancelled and `error_fun(error_message)` is
   called when an error occurs during the IRMA session.
        * Start session must be imported from `start_session.js`. The easiest way to do this is wrapping its call in
        `$.getScript("../../start_session.js", ...)`. For this, jquery and irmajs are needed as dependencies.
        
Alternatively, you could just copy and adjust an existing demo.
