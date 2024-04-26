# magento-docker

`magento-docker` is Docker environment for easy to set up, configure, debug Magento2 with Live Search instance.

### Requirements

* [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
* [Docker](https://docs.docker.com/)
* [Docker Compose](https://docs.docker.com/compose/install/)
* Setup SSH-keys on your github account. (see [docs](https://help.github.com/en/github/authenticating-to-github/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent)  for [help](https://help.github.com/en/github/authenticating-to-github/adding-a-new-ssh-key-to-your-github-account))

* Install Mutagen [docs](https://mutagen.io/documentation/introduction/installation)
* Ensure you do not have `dnsmasq` installed/enabled locally (will be auto-installed if you've use Valet+ to install Magento)


### How to install

#### Steps
1. Create a directory where all repositories will be cloned (used in your IDE)
 
    Proposed structure:
```
    ~/projects/livesearch/magento-docker    # this repo
    ~/projects/livesearch/repos             # directory with repositories - MAGENTO_PATH in scripts
```

2. Copy `.env.dist` in `.env` and update `MAGENTO_PATH` with recently created repos path. `DOCKER_PATH` is the path to which magento-docker was cloned (`~/projects/livesearch/magento-docker` in example).

3. Add `$MAGENTO_DOMAIN` from .env to hosts, e.g.:

```
    sudo -- sh -c "echo '127.0.0.1 magento.test' >> /etc/hosts"
```

4. Add [Magento authentication](https://marketplace.magento.com/customer/accessKeys/) keys to access the Magento Commerce repository
 * copy the contents of `etc/php/auth.json.dist` to new `etc/php/auth.json` file and replace placeholders with your credentials.

### Project start

Note, for the first installation (when you don't have cloned repositories yes) please change settings "RECLONE" to "yes" in ".env" file

### Configuration

    MAGENTO_PATH=~/projects/livesearch/reposl       # local directory to clone repos into
    RECLONE=yes                                     # flag indicate whether do re-clon of all repos or no, set yes to clone at first time
    MAGENTO_EDITION=CE                              # CE|EE|B2B
    Notices:

### Project install

* RUN `mutagen project start` to start project (repositories clone, linking, configuration)
* If you're getting the error `init_project: line 16: export: `#NEW_REPOS': not a valid identifier` and don't use `NEW_REPOS`, delete that line safely in `.env` file.
* Log in to the Admin UI (use `ADMIN_USER`/`ADMIN_PASSWORD` from `.env`), 
* Navigate to Stores > Configuration > Services > Commerce Services Connector
* Get your QA API credentials from [DEV API Portal](https://account-stage.magedevteam.com/apiportal/index/index/) with Environment as *QA* and save them in Admin UI.
* Get your PROD API credentials from [API Portal](https://account.magento.com/apiportal/index/index/) with Environment as *Production* and save them in Admin UI.
* Refer to [this](https://experienceleague.adobe.com/docs/commerce-merchant-services/user-guides/integration-services/saas.html?lang=en) document for additional information.
* to sync products to SaaS run the following commands (before commerce-data export v103.0.0):
```
bin/magento saas:resync --feed productattributes
bin/magento saas:resync --feed products
bin/magento saas:resync --feed productoverrides
```
since commerce-data export v103.0.0 the following feeds must be run:
```
bin/magento saas:resync --feed products
bin/magento saas:resync --feed productattributes
bin/magento saas:resync --feed categories
bin/magento saas:resync --feed categoryPermissions
bin/magento saas:resync --feed prices
bin/magento saas:resync --feed productOverrides
bin/magento saas:resync --feed variants
bin/magento saas:resync --feed scopesWebsite
bin/magento saas:resync --feed scopesCustomerGroup
```         
* to sync product updates simply run
```
bin/magento cron:run
bin/magento cron:run
```

### Container files sync issues
If you have issues with mutagen files sync (no changes from host reflected in files in containers, sync errors if running `mutagen sync list`), do the following: 
* run `mutagen sync list` to get list of syncs, output may look like this:
```
Name: code
Identifier: sync_rFbovEduhlHv6ZOFWlNt4WFaWPRmHEU44fiNbhZXMwv
Labels:
	io.mutagen.project: proj_h8cbq5g9tO2MZw278MeyeyizVJtHRujJyWbLYd5wnhm
Alpha:
	URL: /Users/ruslankostiv/projects/livesearch/repos
	Connection state: Connected
Beta:
	URL: docker://web-mutagen/var/www
	Connection state: Connected
Status: Watching for changes
```
* use sync identifier (`sync_rFbovEduhlHv6ZOFWlNt4WFaWPRmHEU44fiNbhZXMwv` in example above) to flush the sync, `mutagen sync flush sync_rFbovEduhlHv6ZOFWlNt4WFaWPRmHEU44fiNbhZXMwv`

### Install extensions from GitHub repositories after project installed
* navigate to folder where Magento repositories were cloned (`MAGENTO_PATH` from `.env`, for example `~/projects/livesearch/repos`)
* clone GitHub needed repositories into `MAGENTO_PATH` folder (`git clone https://github.com/magento-commerce/saas-prices-provider`. for example)
* navigate to app container (`docker-compose exec app bash`)
* to create symlinks to Magento project, command from [reinstall](https://github.com/duhon/magento-docker/blob/382d9b6a07a2c0c6fe7ae04991ac3d2e7203b514/etc/php/tools/reinstall#L27) script will be used
* run `php -f /var/www/magento2ee/dev/tools/build-ee.php -- --command link --exclude true --ce-source /var/www/magento2ce/app/code/Magento --ee-source /var/www/${edition}`, replace `${edition}` with name of folder was created after cloning GitHub repository (for example `saas-prices-provider`)
* to make sure that extension available, run `bin/magento module:status` and check that extension is in the list of disabled modules.
* run `bin/magento module:enable <module_list_of_modules>` to enable them
* run `bin/magento setup:upgrade` to apply extension changes
* if there's an error `Module does not exist` it means cloned repositories were not synced between host and container after they cloned. To fix it, follow "Container files sync issues" steps.

### Troubleshooting
   * Add MAGENTO_PATH path to Docker sharing folders (Docker preferences) in case docker-error
   * If you see certificate errors. Make `https://magento.test` certificate trusted with [these steps](https://support.pkware.com/home/sfd/15.7/macos/macos-how-to/macos-trusting-a-ssl-certificate).
## Scenarios

#### SaaS connector credentials setup

* After first project install you can automate pre-filling of SaaS credentials (pretty useful if you reinstall Magento often)
* Navigate to `etc/php/magento-config.php.dist` 
* copy it to `etc/php/magento-config.php` (available locally, ignored for commits)
* find node `services_connector` and fill sub-nodes according to the values from `Commerce Services Connector`. 
* See comments regarding each config value. 

#### Container operations

* enter the container (see `docker-composer.yml` for app name - `web`, `db`, `app`, etc.)  
`docker-compose exec <app_name> bash` -> `docker-compose exec app bash`

* stop all containers  
`docker-compose stop`

* start all containers in background:  
`docker-compose up -d`

* restart all containers:   
`docker-compose restart` 

* stop container:  
`docker-compose stop <app_name>`

* start container in background:  
`docker-compose up -d <app_name>`

* restart container:  
`docker-compose restart <app_name>`

* remove container:
`docker-compose rm <app_name>` (will remove container, but not volumes)

#### Emails sending

MailHog is used to receive emails sent by Magento, navigate to http://localhost:8025/ to see them.

#### Run tests (in progress, can be not stable)

1. `docker-compose exec app magento prepare_tests`
2. `docker-compose exec app bin/magento dev:tests:run (unit, integration)`
   (:!:) (make sure db `magento_integration_tests` created before integration tests run)

3. `docker-compose exec app bash`
4. `cd dev/tests/acceptance/ and vendor/bin/codecept run (mftf)`
5. `cd dev/tests/functional/ and vendor/bin/phpunit run (mtf)`
6. `vnc://localhost:5900 pass:secret (mftf or mtf)`

#### Enable/disable Xdebug 

* Enable: `mutagen project run xdebug-enable`
* Disable: `mutagen project run xdebug-disable`

:warning: Enabled Xdebug may slow your environment.  
:exclamation: port `9003` is used for debug. 

# How to configure PHPSTORM to use debugger for CLI commands:
- Once xdebug in enabled, create a new PHP CLI Interpretor with SSH Configuration:
![alt text](https://user-images.githubusercontent.com/2975006/181732593-507e7c09-e99f-40ec-b70e-a1403d13184e.png)

- Then, create a new Run/Debug Configuration with path mapping:
![alt text](https://user-images.githubusercontent.com/2975006/181730715-7d8cacd2-4810-4a0a-934b-35acc298b057.png)

#### Re-link dependencies to Magento Open Source (CE)

* `docker-compose exec app magento relink`

#### Magento (Re)-Installation

* `docker-compose exec app magento reinstall`

#### Optimization host

1. [Optimization for MacOS](https://gist.github.com/tombigel/d503800a282fcadbee14b537735d202c)

#### Project termination (:!: proceed with caution, removes all containers and volumes)

RUN `mutagen project terminate`

### FAQ
1. If docker containers do not go up, check errors in console, run `docker-compose down`, fix issue and run `docker-compose up` again.
2. If `Overwrite the existing configuration for db-ssl-verify?[Y/n]` prompts in the console, type `Y`.
3. If magento installation fails, run `docker-compose exec app magento reinstall`
