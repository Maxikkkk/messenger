# messenger
Simple Magento 2 extension that help you to send messages on your friends email!

## Features 
- Send messages to your friends
- Change,
- Create or 
- Delete customer messages from the admin panel
- REST, SOAP APIs and additional GraphQl extension

## Installation
Extension requires **Magento 2.4+ version**

```sh
cd [magento_installation_path]
mkdir profstep
git clone https://github.com/Maxikkkk/messenger
composer config repositories.messenger path ./messenger/profstep-messages
composer require profstep/module-messages
bin/magento mod:en ProfStep_Messages
```
For GraphQl extension
```sh
composer config repositories.messenger path ./messenger/profstep-messages
composer require profstep/module-messages-graph-ql
bin/magento mod:en ProfStep_MessagesGraphQl
```
