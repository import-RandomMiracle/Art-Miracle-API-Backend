<?php

use Illuminate\Http\Request;

interface Validatable {
    function validateOnStore(Request $request);
    function validateOnUpdate(Request $request);
}
