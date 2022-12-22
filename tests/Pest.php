<?php

use FlixtechsLabs\TurboLaravelHelpers\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

it('can add a stimulus controller when called', function () {
    $this->assertEquals('data-controller="helo" ', stimulus_controller('helo'));

    $this->assertEquals('data-controller="hello" data-hello-user-value="world"', stimulus_controller('hello', [
        'user' => 'world'
    ]));
});

it('can add multiple stimulus controllers when called', function ($controllers) {
    $attribute = 'data-controller="';

    foreach ($controllers as $key => $controller) {
        if ($key === count($controllers) - 1) {
            $attribute .= $controller . '" ';
            continue;
        }

        $attribute .= $controller . ' ';
    }

    $this->assertEquals($attribute, stimulus_controllers(...$controllers));
})->with([
    [['player', 'controls', 'playlist']],
    [['profile', 'image-upload']]
]);

it('can add multiple stimulus controllers when called with values', function () {
    $this->assertEquals('data-controller="player controls" data-player-playlist-value="' . e(json_encode(['song1', 'song2'])) .'"', stimulus_controllers(['player', [
        'playlist' => ['song1', 'song2']
    ]], 'controls'));
});

it('can add a stimulus action when called', function () {
    $this->assertEquals('data-action="click->controls#pause"', stimulus_action('controls', 'pause', 'click'));
});

it('can add multiple stimulus actions when called', function () {
    $this->assertEquals('data-action="click->controls#pause click->player#updatePosition"', stimulus_actions([
        ['controls' => ['pause', 'click']],
        ['player' => ['updatePosition', 'click']]
    ]));
});

it('can add a stimulus target when called', function () {
    $this->assertEquals('data-player-target="cover"', stimulus_target('player', 'cover'));
});

it('can add multiple stimulus targets when called', function () {
    $this->assertEquals('data-player-target="cover" data-controls-target="progress"', stimulus_targets([['player', 'cover'], ['controls', 'progress']]));
});
