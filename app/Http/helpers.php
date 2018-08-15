<?php

    function jsonResponse($status)
    {
        return response()->json(compact('status'));
    }