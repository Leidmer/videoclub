<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testTots()
    {
        $this->browse(function (Browser $browser) {
            //El meu portàtil es bastant lent i he posat 2000 a les pauses
            //Fem un login
            $browser->visit('/Laravel/Laravel/videoclub/public/login')
                    ->waitForText('Login')
                    ->type('email', 'usuari1@cendraclub.com')
                    ->type('password','1234')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/Laravel/Laravel/videoclub/public/catalog')
                    ->pause(2000)
            //Busquem una peli que no existeix
                    ->type('buscador','Una peli')
                    ->click('button[type="submit"]')
                    ->pause(2000)
            //Busquem una peli que si existeix
                    ->type('buscador','Pulp Fiction')
                    ->click('button[type="submit"]')
                    ->pause(2000)
            //Entrem a la peli que hem buscat, surt un avís de cookies associades amb youtube però el test surt OK
                    ->clickLink('Pulp Fiction')
                    ->assertPathIs('/Laravel/Laravel/videoclub/public/catalog/show/4')
                    ->pause(2000)
            //Anem al final de la pàgina, poso 2000 per asegurar que va al final de tot
                    ->driver->executeScript('window.scrollTo(0, 2000);');
            //Afageixo un comentari now
                    //->type('title','Star Wars: Episode III') Sense posar $browser davant no funcionava
                    $browser->type('title','Star Wars: Episode III')
                    ->select('stars','5')
                    ->type('review','ERAS MI HERMANO ANAKIN, YO TE QUERIA')
                    ->click('button[type="submit"]')
                    ->pause(2000)
            //Creo una nova peli
                    ->clickLink('Nueva película')
                    ->type('title','Nova Peli')
                    ->type('synopsis','Un resum molt guai de la nova peli')
                    ->type('trailer','https://www.youtube.com/watch?v=dhsLanjjmDc')
                    ->click('button[type="submit"]')
                    ->pause(2000)
                    ->visit('/Laravel/Laravel/videoclub/public/catalog')
            //Tanco la sessió i comprovo que el path es el del login
                    ->press('Cerrar sesión')
                    ->assertPathIs('/Laravel/Laravel/videoclub/public/login')
                    ->pause(2000);
            

        });
    }
}

