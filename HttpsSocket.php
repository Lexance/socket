<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket;

class HttpsSocket extends HttpSocket
{
    /**
     * {@inheritdoc}
     */
    public static function applicable()
    {
        return 'https_socket';
    }
}