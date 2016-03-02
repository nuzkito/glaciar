<?php

function markdownToHtml($markdown)
{
    return Parsedown::instance()->text($markdown);
}
