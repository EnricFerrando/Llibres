<?php
test('app name is accessible', function () {
expect(config('app.name'))->not->toBeNull();
});