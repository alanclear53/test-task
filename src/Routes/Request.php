<?php

namespace Routes;

class Request {
    public function getBody() {
        return json_decode(file_get_contents('php://input'), true);
    }
}