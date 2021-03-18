[![Build Status](https://travis-ci.com/landingi/modular-monolith-bundle.svg?branch=master)](https://travis-ci.com/landingi/modular-monolith-bundle)
[![License MIT](https://img.shields.io/apm/l/vim-mode.svg)](https://opensource.org/licenses/MIT)
![Packagist Version](https://img.shields.io/packagist/v/landingi/event-store-bundle)

# Modules in Modular Monolith
From the point of view of a modular monolith, it is important not to introduce code level coupling between its modules.

## Communication

Communication within a modular monolith between specific modules should not introduce code level couplings. Each module must be treated as a separate element of the system (we can even say that each module is a microservice inside the monolith). In order to meet such requirements, communication between modules can be carried out in two ways, depending on the specific demand.

The way of communication is modeled on that presented by Bottega (Devmentors) in their example Modular Monolith written in .net technology. The idea was absorbed and adapted to PHP technology (unfortunately, not everything could be done as nicely and generically as in .net).

- *(NOT READY)* We can react to public events (application / integration) from the point of view of the module.
- *(READY)* We can throw requests to a specific module using a mechanism similar to the Http protocol. This implementation is now ready and usable. The whole thing works completely inside the memory which guarantees high performance.

In the event-driven architecture, communication mainly takes place through integration events. However, not everything is playable by events. These are mainly modules containing generic contexts that can be used by multiple modules. Here, "module requests" comes to our aid.

### 1. Integration/application events

*(To be implemented)*

### 2. Module requests

The idea behind requests between modules using what we have termed "module request" is to be able to communicate between modules within a modular monolith as if we had a distributed architecture in the case of microservices. This allows us to run the project without introducing hacks and couplings between specific elements of the system. In addition, the implementation allows you to easily extract a specific module as a microservice, if necessary.

Of course, the current implementation is just the beginning. It supports the basic assumptions, but there is probably room for improvement. The current implementation is inside the memory, if one day one of the modules is pulled out as a microservice beyond a monolith, then a new ModuleClient implementation should be added to support communication via the infrastructure.

#### 2. 1. How it works?

Any module wishing to make a certain resource available for other modules should add "request handler" at a specific path (the path should be in a format similar to that of HTTP, for example: "module/acl/v1/is-functionality-granted". Subscribing at this time all requests going to this path in the same way as we would do in the case of API via HTTP, except that everything happens by default in memory (of course, extracting the module as a microservice and changing communication is not a problem as I mentioned before).

So we are registering the handler in Symfony DI using tag: `app.module.handler` with given request path: `module/acl/v1/is-functionality-granted`:

```yaml
Acl\Application\ModuleRequest\Handler\IsFunctionalityGrantedHandler:
    arguments: ['@Acl\Application\Service\AccessService']
    tags:
        - { name: 'app.module.handler', path: 'module/acl/v1/is-functionality-granted' }
```

This handler will handle requests to ACL to check permissions from the other modules, and again exactly in the same way as it would be in HTTP API.

Then, from the level of another module, e.g. lightboxes, we can easily introduce the ACL checking service (remember that each module is an individual entity). In this service we will simply call via `ModuleClient` our created handler without any code level coupling:

```php
use SharedKernel\Application\Module\GenericMessage;

$accountUuid = 'c87ceb7b-4272-4126-abeb-1d778ff89ed2';
$userUuid = '639e4f08-d176-4c15-9f2f-94ad69d6ccd9';
$functionalityPermission = 'lightboxes.view_list';

$result = $this->moduleClient->request(
    'module/acl/v1/is-functionality-granted',
    new GenericMessage(
        [
            'account_uuid' => (string) $accountUuid,
            'user_uuid' => (string) $userUuid,
            'permission' => $functionalityPermission
        ]
    )
);
```

In the `$result` variable we will simply get our handler result. Exactly the same way as we would while calling the HTTP API.
