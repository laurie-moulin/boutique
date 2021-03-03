<?php

namespace db;

class messages
{
    public $messages;

    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    public function renderMessage()
    {
        $message = $this->messages;
        if (!empty($message)) {
            $output = "";
            if (count($message) > 0) {
                $output .= "<ul style='color: red' id='error'>ATTENTION ! <br>";
                foreach ($message as $errors) {
                    $output .= "<li class= mess text-justify style='color: red'>" . $errors . "</li>";
                }
                $output .= "</ul>";
            } else {
                $output = $message[0];
            }
            return "<div id='error'>"
                . $output .
                "</div>";
        } else {
            return "";
        }
    }
}