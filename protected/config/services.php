<?php
return     array(// You can change the providers and their classes.
                'onetime' => array(
                    'class' => 'lily.services.LOneTimeService',
                ),
                'email' => array(
                    'class' => 'lily.services.LEmailService',
                ),
                'google' => array(
                    'class' => 'lily.services.LGoogleService',
                ),
                'yandex' => array(
                    'class' => 'lily.services.LYandexService',
                ),
                
                'twitter' => array(
                    // регистрация приложения: https://dev.twitter.com/apps/new
                    'class' => 'lily.services.LTwitterService',
                    'key' => '..',
                    'secret' => '..',
                ),
                'vkontakte' => array(
                    // регистрация приложения: http://vkontakte.ru/editapp?act=create&site=1
                    'class' => 'lily.services.LVKontakteService',
                    'client_id' => '..',
                    'client_secret' => '..',
                ),
                'mailru' => array(
                    // регистрация приложения: http://api.mail.ru/sites/my/add
                    'class' => 'lily.services.LMailruService',
                    'client_id' => '..',
                    'client_secret' => '..',
                ),
                
            );
