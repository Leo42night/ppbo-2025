<?php

namespace App\Models;

interface Displayable {
    public function getDisplayHtml(): string;
}