<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;
}
