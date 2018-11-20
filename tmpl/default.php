<?php

/**
 * @package    Radical MultiField
 *
 * @author     delo-design.ru <info@delo-design.ru>
 * @copyright  Copyright (C) 2018 "Delo Design". All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://delo-design.ru
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

$input = Factory::getApplication()->input->getArray();
$context = $input['option']. '.' . $input['view'];

if(!in_array($context, ['com_content.article', 'com_users.user', 'com_contact.contact']))
{
    return;
}

if (!$field->value)
{
    return;
}


$values = json_decode($field->value, JSON_OBJECT_AS_ARRAY);
$listtype = $this->getListTypeFromField($field);


HTMLHelper::stylesheet('plg_radicalmultifield_audioplayer/player.css', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::script('plg_radicalmultifield_audioplayer/id3-minimized.js', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::script('plg_radicalmultifield_audioplayer/color-thief.js', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);

HTMLHelper::script('https://unpkg.com/wavesurfer.js', [
    'version' => filemtime ( __FILE__ ),
    'relative' => true,
]);


$buttonPrimary = $field->fieldparams->get('buttonPrimary');
$buttonPrimaryIcon = $field->fieldparams->get('buttonPrimaryIcon');
$buttonTransparentIcon = $field->fieldparams->get('buttonTransparentIcon');

$svgMap = [
    'share' => '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22px" height="22px" viewBox="0 0 48.665 48.665" style="enable-background:new 0 0 48.665 48.665;" 	 xml:space="preserve"> <g> 	<g> 		<path fill="' . $buttonPrimaryIcon . '" d="M40.332,31.592c-2.377,0-4.515,1-6.033,2.598l-17.737-8.686c0.061-0.406,0.103-0.82,0.103-1.246 			c0-0.414-0.04-0.818-0.098-1.215l17.711-8.589c1.519,1.609,3.666,2.619,6.054,2.619c4.603,0,8.333-3.731,8.333-8.333 			c0-4.603-3.73-8.333-8.333-8.333s-8.333,3.73-8.333,8.333c0,0.414,0.04,0.817,0.098,1.215l-17.709,8.589 			c-1.519-1.609-3.666-2.619-6.054-2.619C3.73,15.925,0,19.656,0,24.258c0,4.603,3.73,8.333,8.333,8.333 			c2.377,0,4.515-1,6.033-2.596l17.736,8.685c-0.062,0.406-0.104,0.82-0.104,1.245c0,4.604,3.73,8.333,8.333,8.333 			s8.333-3.729,8.333-8.333C48.665,35.322,44.935,31.592,40.332,31.592z"/> 	</g> </g></svg>',
    'maxVolume' => '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 	 width="24px" height="24px" viewBox="0 0 475.082 475.081" style="enable-background:new 0 0 475.082 475.081;" 	 xml:space="preserve"> <g> 	<g> 		<path fill="' . $buttonPrimaryIcon . '" d="M200.999,63.952c-4.946,0-9.229,1.812-12.847,5.426l-95.074,95.075H18.276c-4.952,0-9.234,1.812-12.85,5.424 			C1.809,173.493,0,177.778,0,182.726v109.63c0,4.949,1.809,9.233,5.426,12.848c3.619,3.617,7.902,5.427,12.85,5.427h74.798 			l95.074,95.078c3.617,3.61,7.9,5.424,12.847,5.424c4.952,0,9.234-1.813,12.85-5.424c3.617-3.614,5.426-7.901,5.426-12.847V82.228 			c0-4.948-1.809-9.234-5.422-12.85C210.23,65.764,205.951,63.952,200.999,63.952z"/> 		<path fill="' . $buttonPrimaryIcon . '" d="M316.769,277.936c8.093-12.467,12.135-25.93,12.135-40.395s-4.042-27.992-12.135-40.556 			c-8.094-12.562-18.791-21.41-32.121-26.551c-1.902-0.949-4.284-1.427-7.139-1.427c-4.944,0-9.232,1.762-12.847,5.282 			c-3.61,3.521-5.427,7.852-5.427,12.99c0,3.997,1.143,7.376,3.432,10.137c2.283,2.762,5.041,5.142,8.282,7.139 			c3.23,1.998,6.468,4.188,9.708,6.567c3.238,2.38,5.996,5.758,8.278,10.135c2.276,4.38,3.426,9.804,3.426,16.277 			c0,6.471-1.143,11.896-3.426,16.276c-2.282,4.381-5.04,7.755-8.278,10.14c-3.24,2.379-6.478,4.569-9.708,6.567 			c-3.241,1.992-5.999,4.377-8.282,7.132c-2.282,2.765-3.432,6.143-3.432,10.14c0,5.144,1.816,9.47,5.427,12.99 			c3.614,3.521,7.902,5.288,12.847,5.288c2.854,0,5.236-0.479,7.139-1.424C297.978,299.304,308.679,290.403,316.769,277.936z"/> 		<path fill="'. $buttonPrimaryIcon . '" d="M377.728,318.194c16.18-24.646,24.273-51.531,24.273-80.654c0-29.124-8.094-56.005-24.273-80.666 			c-16.177-24.645-37.6-42.583-64.241-53.815c-2.471-0.95-4.948-1.427-7.416-1.427c-4.948,0-9.236,1.809-12.854,5.426 			c-3.613,3.616-5.424,7.898-5.424,12.847c0,7.424,3.713,13.039,11.139,16.849c10.657,5.518,17.888,9.705,21.693,12.559 			c14.089,10.28,25.077,23.173,32.976,38.686c7.898,15.514,11.848,32.026,11.848,49.537c0,17.512-3.949,34.023-11.848,49.536 			c-7.898,15.516-18.894,28.407-32.976,38.684c-3.806,2.857-11.036,7.043-21.693,12.563c-7.426,3.809-11.139,9.424-11.139,16.847 			c0,4.948,1.811,9.236,5.424,12.847c3.617,3.621,7.991,5.432,13.131,5.432c2.286,0,4.668-0.483,7.139-1.428 			C340.128,360.783,361.551,342.844,377.728,318.194z"/> 		<path fill="' . $buttonPrimaryIcon . '" d="M438.824,116.92c-24.171-36.638-56.343-63.622-96.505-80.943c-2.471-0.95-4.948-1.425-7.416-1.425 			c-4.948,0-9.236,1.811-12.847,5.424c-3.621,3.615-5.432,7.902-5.432,12.85c0,6.851,3.714,12.469,11.14,16.846 			c1.335,0.756,3.467,1.755,6.42,2.996c2.95,1.232,5.089,2.231,6.427,2.993c8.754,4.755,16.56,9.611,23.418,14.56 			c23.407,17.318,41.682,38.922,54.816,64.809c13.134,25.885,19.697,53.388,19.697,82.512c0,29.129-6.563,56.626-19.697,82.512 			c-13.131,25.889-31.409,47.496-54.816,64.809c-6.858,4.948-14.664,9.801-23.418,14.562c-1.338,0.756-3.477,1.752-6.427,2.99 			c-2.953,1.232-5.085,2.231-6.42,2.998c-7.426,4.374-11.14,9.993-11.14,16.844c0,4.949,1.811,9.233,5.432,12.848 			c3.61,3.617,7.898,5.427,12.847,5.427c2.468,0,4.945-0.476,7.416-1.431c40.162-17.315,72.334-44.3,96.505-80.94 			c24.174-36.638,36.258-76.849,36.258-120.625S463.001,153.554,438.824,116.92z"/> 	</g> </g></svg>',
    'minVolume' => '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 	 width="24px" height="24px" viewBox="0 0 475.082 475.081" style="enable-background:new 0 0 475.082 475.081;" 	 xml:space="preserve"> <g> 	<g> 		<path fill="' . $buttonPrimaryIcon . '" d="M200.999,63.952c-4.946,0-9.229,1.812-12.847,5.426l-95.074,95.075H18.276c-4.952,0-9.234,1.812-12.85,5.424 			C1.809,173.493,0,177.778,0,182.726v109.63c0,4.949,1.809,9.233,5.426,12.848c3.619,3.617,7.902,5.427,12.85,5.427h74.798 			l95.074,95.078c3.617,3.61,7.9,5.424,12.847,5.424c4.952,0,9.234-1.813,12.85-5.424c3.617-3.614,5.426-7.901,5.426-12.847V82.228 			c0-4.948-1.809-9.234-5.422-12.85C210.23,65.764,205.951,63.952,200.999,63.952z"/>	</g> </g></svg>',
    'currentPlay' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.999 41.999" style="enable-background:new 0 0 41.999 41.999;" xml:space="preserve"><path fill="' . $buttonPrimaryIcon . '" d="M36.068,20.176l-29-20C6.761-0.035,6.363-0.057,6.035,0.114C5.706,0.287,5.5,0.627,5.5,0.999v40c0,0.372,0.206,0.713,0.535,0.886c0.146,0.076,0.306,0.114,0.465,0.114c0.199,0,0.397-0.06,0.568-0.177l29-20c0.271-0.187,0.432-0.494,0.432-0.823S36.338,20.363,36.068,20.176z"/></svg>',
    'currentPause' => '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 438.536 438.536" style="enable-background:new 0 0 438.536 438.536;" xml:space="preserve"><g><g><path fill="' . $buttonPrimaryIcon . '" d="M164.453,0H18.276C13.324,0,9.041,1.807,5.425,5.424C1.808,9.04,0.001,13.322,0.001,18.271v401.991c0,4.948,1.807,9.233,5.424,12.847c3.619,3.617,7.902,5.428,12.851,5.428h146.181c4.949,0,9.231-1.811,12.847-5.428c3.617-3.613,5.424-7.898,5.424-12.847V18.271c0-4.952-1.807-9.231-5.428-12.847C173.685,1.807,169.402,0,164.453,0z"/><path fill="' . $buttonPrimaryIcon . '" d="M433.113,5.424C429.496,1.807,425.215,0,420.267,0H274.086c-4.949,0-9.237,1.807-12.847,5.424c-3.621,3.615-5.432,7.898-5.432,12.847v401.991c0,4.948,1.811,9.233,5.432,12.847c3.609,3.617,7.897,5.428,12.847,5.428h146.181c4.948,0,9.229-1.811,12.847-5.428c3.614-3.613,5.421-7.898,5.421-12.847V18.271C438.534,13.319,436.73,9.04,433.113,5.424z"/></g></g></svg>',
    'prev' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve"><g><g><path fill="' . $buttonTransparentIcon . '" d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/></g></g></svg>',
    'next' => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve"><g><g><path fill="' . $buttonTransparentIcon . '" d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/></g></g></svg>',
    'itemPlay' => '<svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.999 41.999" style="enable-background:new 0 0 41.999 41.999;" xml:space="preserve"><path fill="' . $buttonPrimaryIcon . '" d="M36.068,20.176l-29-20C6.761-0.035,6.363-0.057,6.035,0.114C5.706,0.287,5.5,0.627,5.5,0.999v40c0,0.372,0.206,0.713,0.535,0.886c0.146,0.076,0.306,0.114,0.465,0.114c0.199,0,0.397-0.06,0.568-0.177l29-20c0.271-0.187,0.432-0.494,0.432-0.823S36.338,20.363,36.068,20.176z"/></svg>',
    'itemPause' => '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 438.536 438.536" style="enable-background:new 0 0 438.536 438.536;" xml:space="preserve"><g><g><path fill="'. $buttonPrimaryIcon. '" d="M164.453,0H18.276C13.324,0,9.041,1.807,5.425,5.424C1.808,9.04,0.001,13.322,0.001,18.271v401.991c0,4.948,1.807,9.233,5.424,12.847c3.619,3.617,7.902,5.428,12.851,5.428h146.181c4.949,0,9.231-1.811,12.847-5.428c3.617-3.613,5.424-7.898,5.424-12.847V18.271c0-4.952-1.807-9.231-5.428-12.847C173.685,1.807,169.402,0,164.453,0z"/><path fill="'. $buttonPrimaryIcon . '" d="M433.113,5.424C429.496,1.807,425.215,0,420.267,0H274.086c-4.949,0-9.237,1.807-12.847,5.424c-3.621,3.615-5.432,7.898-5.432,12.847v401.991c0,4.948,1.811,9.233,5.432,12.847c3.609,3.617,7.897,5.428,12.847,5.428h146.181c4.948,0,9.229-1.811,12.847-5.428c3.614-3.613,5.421-7.898,5.421-12.847V18.271C438.534,13.319,436.73,9.04,433.113,5.424z"/></g></g></svg>',
];

foreach ($svgMap as $key => $value) {
    $svgMap[$key] = 'data:image/svg+xml;utf8,' . str_replace('#', '%23', $value);
}


$style = <<<CSS

.audio-current .audio-current-button-share span {
	background-image: url('{$svgMap['share']}')
}

.audio-current .audio-current-button-volume.max span {
	background-image: url('{$svgMap['maxVolume']}');
}

.audio-current .audio-current-button-volume.min span {
	background-image: url('{$svgMap['minVolume']}');
}

.audio-current .audio-current-button-pause-play.play span {
	background-image: url('{$svgMap['currentPlay']}');
}

.audio-current .audio-current-button-pause-play.pause span {
	background-image: url('{$svgMap['currentPause']}');
}

.audio-current .audio-current-button-prev span {
	background-image: url('{$svgMap['prev']}');
}

.audio-current .audio-current-button-next span {
	background-image: url('{$svgMap['next']}');
}

.audio-lists .audio-item .audio-item-button-play-pause.play span {
	background-image: url('{$svgMap['itemPlay']}');
}

.audio-lists .audio-item .audio-item-button-play-pause.pause span {
	background-image: url('{$svgMap['itemPause']}');
}

.audio-current .audio-current-button-prev:hover,
.audio-current .audio-current-button-next:hover {
    border: 1px solid {$buttonTransparentIcon};
    transition: all 0.2s;
}

.audio-current-share > div button {
    background: {$buttonPrimary};
    color: $buttonPrimaryIcon;
}

.audio-current .audio-current-button-volume,
.audio-current .audio-current-button-share {
    background: {$buttonPrimary};
}

.audio-current .audio-current-button-pause-play {
    background: {$buttonPrimary};
}

.audio-lists .audio-item .audio-item-play .audio-item-button-play-pause {
    background: {$buttonPrimary};
}

CSS;

Factory::getDocument()->addStyleDeclaration($style);

?>


<div class="audio-player-wrap">

    <div class="audio-current">

        <div class="audio-current-background" style="background-image: url('/media/plg_radicalmultifield_audioplayer/img/music-default.png')"></div>

        <div class="audio-current-share">
            <div>
                <button class="audio-current-button-share-close">Закрыть</button>
                <input type="text" />
                <button class="audio-current-button-share-copy">Скопировать ссылку</button>
            </div>
        </div>

        <div class="audio-current-content">
            <div class="audio-current-head">

                <div class="audio-current-image">
                    <img src="/media/plg_radicalmultifield_audioplayer/img/music-default.png" />
                </div>

                <div class="audio-current-name">
                    <span class="name"></span>
                    <span class="album"></span>
                </div>

                <div class="audio-current-action">
                    <button class="audio-current-button-volume max"><span></span></button>
                    <button class="audio-current-button-share"><span></span></button>
                </div>

            </div>


            <div class="audio-current-waveform">
                <div id="waveform">

                </div>
            </div>

            <div class="audio-current-actions">
                <button class="audio-current-button-prev"><span></span></button>
                <button class="audio-current-button-pause-play play"><span></span></button>
                <button class="audio-current-button-next"><span></span></button>
            </div>
        </div>


    </div>

    <div class="audio-lists">
        <?php $i = 1; ?>
        <?php foreach ($values as $key => $row): ?>

            <div class="audio-item" data-file="/<?= $row['file'] ?>">
                <div class="audio-item-play">
                    <button class="audio-item-button-play-pause play"><span></span></button>
                </div>

                <div class="audio-item-name">
                    <span class="musician"><?= $row['musician'] ?></span>
                    <span class="name"><?= $row['name'] ?></span>
                </div>
            </div>

            <?php $i++; ?>
        <?php endforeach; ?>
    </div>


</div>


<script type="text/javascript">

    jQuery(document).ready(function () {

        let coverDefault = '/media/plg_radicalmultifield_audioplayer/img/music-default.png';
        let countTracks = jQuery('.audio-lists').find('.audio-item').length;
        let currentI;
        let play = false;
        let load = false;
        let wavesurfer = WaveSurfer.create({
            container: '#waveform',
            waveColor: '<?= $field->fieldparams->get('waveColor') ?>',
            progressColor: '<?= $field->fieldparams->get('progressColor') ?>',
            cursorColor: '<?= $field->fieldparams->get('cursorColor') ?>',
            height: 100,
            backend: 'MediaElement',
            mediaControls: false
        });
        let currentUrl = new URL(location.href);
        let audioId = currentUrl.searchParams.get('audio_id');

        jQuery('.audio-current-button-pause-play').on('click', function () {
            if(play) {
                pauseEnable();
            } else {
                playEnable(true);
            }
        });

        jQuery('.audio-item').each(function (i, el) {
            jQuery(el).attr('data-i', i);

            if((countTracks-1) === i) {
                if(audioId !== null) {
                    changeTrack(audioId);
                    jQuery([document.documentElement, document.body]).animate({
                        scrollTop: jQuery(".audio-player-wrap").offset().top - 100
                    }, 600);
                } else {
                    changeTrack(0);
                }
            }
        });


        jQuery('.audio-item').on('click', function () {
            let tmpI = parseInt(jQuery(this).attr('data-i'));

            if(currentI !== tmpI) {
                changeTrack(tmpI);
                playEnable(true);
            } else {

                if(play) {
                    pauseEnable();
                } else {
                    playEnable(true);
                }
            }

        });

        jQuery('.audio-current-button-prev').on('click', function () {
            let tmpI = currentI - 1;

            if(tmpI < 0) {
                tmpI = countTracks - 1;
            }

            changeTrack(tmpI);
            playEnable(true);
        });

        jQuery('.audio-current-button-next').on('click', function () {
            let tmpI = currentI + 1;

            if(tmpI > (countTracks - 1)) {
                tmpI = 0;
            }

            changeTrack(tmpI);
            playEnable(true);
        });

        jQuery('.audio-current-button-volume').on('click', function () {

           if(jQuery(this).hasClass('max')) {
               wavesurfer.setVolume(0);
               jQuery(this).addClass('min').removeClass('max');
           } else {
               wavesurfer.setVolume(1);
               jQuery(this).addClass('max').removeClass('min');
           }

        });


        jQuery('.audio-current-button-share').on('click', function () {
            let link;

            if(location.href.indexOf('?') !== -1) {

                if(audioId !== null) {
                    link = location.href.replace(/audio_id=[0-9]{0,}/g, 'audio_id=' + currentI);
                } else {
                    link = location.href + '&audio_id=' + currentI;
                }

            } else {
                link = location.href + '?audio_id=' + currentI;
            }

            document.querySelector('.audio-current-share input').focus();
            document.querySelector('.audio-current-share input').value = link;
            document.querySelector('.audio-current-share input').setSelectionRange(0, link.length);
            jQuery('.audio-current-share').css('z-index', '1');
            jQuery('.audio-current-content').css('z-index', '-1');
        });

        jQuery('.audio-current-button-share-close').on('click', function () {
            jQuery('.audio-current-share').css('z-index', '-1');
            jQuery('.audio-current-content').css('z-index', '0');
        });

        jQuery('.audio-current-button-share-copy').on('click', function () {
            jQuery('.audio-current-share input').select();
            document.execCommand("copy");

        });

        wavesurfer.on('ready', function () {
            load = true;
            if(play) {
                playEnable(true);
            }
        });

        wavesurfer.on('finish', function () {
            let tmpI = currentI + 1;

            if(tmpI > (countTracks - 1)) {
                tmpI = 0;
            }

            changeTrack(tmpI);
            playEnable(true);
        });


        function playEnable(reset) {

            if(reset !== null && reset === true) {
                play = false;
            }

            if(!play) {
                jQuery('.audio-current-button-pause-play').removeClass('play').addClass('pause');
                jQuery('.audio-item[data-i=' + currentI + '] .audio-item-button-play-pause').removeClass('play').addClass('pause');
                play = true;
                if(load) {
                    wavesurfer.playPause();
                }
            }
        }

        function pauseEnable() {
            if(play) {
                jQuery('.audio-current-button-pause-play').removeClass('pause').addClass('play');
                jQuery('.audio-item[data-i=' + currentI + '] .audio-item-button-play-pause').removeClass('pause').addClass('play');
                play = false;
                if(load) {
                    wavesurfer.playPause();
                }
            }
        }

        function changeTrack(i)
        {

            i = parseInt(i);

            let item = jQuery('.audio-item[data-i=' + i+ ']');
            let name = item.find('.name').text();
            let file = item.attr('data-file');
            currentI = i;

            jQuery('.audio-item').each(function (i, el) {

                if(currentI === i) {
                    jQuery(el).addClass('audio-item-active');
                } else {
                    jQuery(el).removeClass('audio-item-active');
                }

                jQuery(el).find('.audio-item-button-play-pause').removeClass('pause').addClass('play');

            });

            jQuery('.audio-current-name .name').text(name);
            jQuery('.audio-current .album').text('');

            load = false;
            wavesurfer.empty();
            wavesurfer.load(file);

            ID3.loadTags(file, function() {
                showTags(file);
            }, {
                tags: ["title","artist","album","picture"]
            });

        }

        function showTags(url) {
            let tags = ID3.getAllTags(url);

            jQuery('.audio-current .album').text(tags.album);

            let image = tags.picture;
            if (image) {
                let base64String = "";
                for (let i = 0; i < image.data.length; i++) {
                    base64String += String.fromCharCode(image.data[i]);
                }
                let base64 = "data:" + image.format + ";base64," +
                    window.btoa(base64String);

                jQuery('.audio-current-background').css('background-image', 'url(' + base64 + ')');
                document.querySelector('.audio-current-image img').setAttribute('src', base64);

                let colorThief = new ColorThief();
                let color = colorThief.getColor(document.querySelector('.audio-current-image img'));

                if(color === null) {
                    color = ['68', '68', '68'];
                }

                let yiq = (( parseInt(color[0])*299)+( parseInt(color[1])*587)+( parseInt(color[2])*114))/1000;

                if(yiq >= 200) {
                    jQuery('.audio-current-name').css('color', '#444');
                } else {

                }

            } else {
                jQuery('.audio-current-background').css('background-image', 'url(' + coverDefault + ')');
                document.querySelector('.audio-current-image img').setAttribute('src', coverDefault);
            }
        }

    });

</script>