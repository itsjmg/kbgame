<?php
/*
Plugin Name: Word Typing Game
Plugin URI: https://example.com
Description: A simple word typing game for WordPress.
Version: 1.0
Author: Your Name
Author URI: https://example.com
*/

// Register the shortcode
add_shortcode('word-typing-game', 'word_typing_game_shortcode');

// Enqueue the required scripts and stylesheets
add_action('wp_enqueue_scripts', 'word_typing_game_enqueue_scripts');

function word_typing_game_shortcode() {
    // Read the word list CSV file
    $word_list_path = plugin_dir_path(__FILE__) . 'word_list.csv';
    $word_list_file = fopen($word_list_path, 'r');

    // Parse the CSV file and group words by difficulty level
    $words = array('easy' => array(), 'medium' => array(), 'hard' => array());
    while (($data = fgetcsv($word_list_file, 1000, ',')) !== FALSE) {
        // Skip the header row
        if ($data[0] === 'word') continue;
        
        // Add the word to the appropriate difficulty level
        $words[$data[1]][] = $data[0];
    }

    // Select a random word from a random difficulty level
    $difficulty_levels = array('easy', 'medium', 'hard');
    $random_difficulty = $difficulty_levels[array_rand($difficulty_levels)];
    $random_word = $words[$random_difficulty][array_rand($words[$random_difficulty])];

    // Output the game HTML
    $output = '<div id="word-typing-game">';
    $output .= '<p>Type the word:</p>';
    $output .= '<input type="text" id="word-typing-input">';
    $output .= '<button id="word-typing-submit">Submit</button>';
    $output .= '<p id="word-typing-message"></p>';
    $output .= '</div>';

    // Close the word list CSV file
    fclose($word_list_file);

    // Return the game HTML
    return $output;
}

function word_typing_game_enqueue_scripts() {
    // Enqueue the game script
    wp_enqueue_script('word-typing-game-script', plugin_dir_url(__FILE__) . 'word-typing-game.js', array('jquery'), '1.0', true);

    // Enqueue the game stylesheet
    wp_enqueue_style('word-typing-game-style', plugin_dir_url(__FILE__) . 'word-typing-game.css', array(), '1.0');
}
