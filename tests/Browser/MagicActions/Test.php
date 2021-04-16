<?php

namespace Tests\Browser\MagicActions;

use Livewire\Livewire;
use Tests\Browser\TestCase;
use Tests\Browser\MagicActions\Component;

class Test extends TestCase
{
    public function test_magic_toggle_can_toggle_properties()
    {
        $this->browse(function ($browser) {
            Livewire::visit($browser, Component::class)
                // Toggle boolean property
                ->assertSeeIn('@output', 'false')
                ->waitForLivewire()->click('@toggle')
                ->assertSeeIn('@output', 'true')
                ->waitForLivewire()->click('@toggle')
                ->assertSeeIn('@output', 'false')

                // Toggle nested boolean property
                ->assertSeeIn('@outputNested', 'false')
                ->waitForLivewire()->click('@toggleNested')
                ->assertSeeIn('@outputNested', 'true')
                ->waitForLivewire()->click('@toggleNested')
                ->assertSeeIn('@outputNested', 'false')

                // Append item using key[] syntax
                ->assertNotPresent('@appendItem')
                ->waitForLivewire()->click('@appendTrigger')
                ->assertPresent('@appendItem0')
                ->waitForLivewire()->click('@appendTrigger')
                ->assertPresent('@appendItem1')

                // Append item using key.nested.accessor[] syntax
                ->assertNotPresent('@nestedAppendItem')
                ->waitForLivewire()->click('@nestedAppendTrigger')
                ->assertPresent('@nestedAppendItem0')
                ->waitForLivewire()->click('@nestedAppendTrigger')
                ->assertPresent('@nestedAppendItem1')
            ;
        });
    }
}
