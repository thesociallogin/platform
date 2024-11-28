<?php

namespace App\Server;

use App\Contracts\Connections\ConnectionAuthorizationServerInterface;
use League\OAuth2\Server\AuthorizationServer;

class ConnectionAuthorizationServer extends AuthorizationServer implements ConnectionAuthorizationServerInterface {}
