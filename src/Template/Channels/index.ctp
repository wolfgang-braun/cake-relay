<?php
    use WolfgangBraun\PiRelay\PiRelay;
?>
<?= $this->Form->create() ?>
<div class="row">
    <div class="col-xs-4">
        <?= $this->Form->input('data.channelLabels.' . PiRelay::CHANNEL_1, [
            'type' => 'text',
            'label' => false,
            'value' => $this->Auth->user('data.channelLabels.' . PiRelay::CHANNEL_1),
        ]) ?>
    </div>
    <div class="col-xs-4">
        <?= $this->Form->input('data.channelDurations.' . PiRelay::CHANNEL_1, [
            'type' => 'number',
            'label' => false,
            'value' => $this->Auth->user('data.channelDurations.' . PiRelay::CHANNEL_1),
            'append' => 'sek',
            'class' => 'duration-input'
        ]) ?>
    </div>
    <div class="col-xs-4">
        <div class="channel-link btn btn-default" data-channel="<?= PiRelay::CHANNEL_1 ?>">öffnen</div>
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <?= $this->Form->input('data.channelLabels.' . PiRelay::CHANNEL_2, [
            'type' => 'text',
            'label' => false,
            'value' => $this->Auth->user('data.channelLabels.' . PiRelay::CHANNEL_2),
        ]) ?>
    </div>
    <div class="col-xs-4">
        <?= $this->Form->input('data.channelDurations.' . PiRelay::CHANNEL_2, [
            'type' => 'number',
            'label' => false,
            'value' => $this->Auth->user('data.channelDurations.' . PiRelay::CHANNEL_2),
            'append' => 'sek',
            'class' => 'duration-input'
        ]) ?>
    </div>
    <div class="col-xs-4">
        <div class="channel-link btn btn-default" data-channel="<?= PiRelay::CHANNEL_2 ?>">öffnen</div>
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <?= $this->Form->input('data.channelLabels.' . PiRelay::CHANNEL_3, [
            'type' => 'text',
            'label' => false,
            'value' => $this->Auth->user('data.channelLabels.' . PiRelay::CHANNEL_3),
        ]) ?>
    </div>
    <div class="col-xs-4">
        <?= $this->Form->input('data.channelDurations.' . PiRelay::CHANNEL_3, [
            'type' => 'number',
            'label' => false,
            'value' => $this->Auth->user('data.channelDurations.' . PiRelay::CHANNEL_3),
            'append' => 'sek',
            'class' => 'duration-input'
        ]) ?>
    </div>
    <div class="col-xs-4">
        <div class="channel-link btn btn-default" data-channel="<?= PiRelay::CHANNEL_3 ?>">öffnen</div>
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <?= $this->Form->input('data.channelLabels.' . PiRelay::CHANNEL_4, [
            'type' => 'text',
            'label' => false,
            'value' => $this->Auth->user('data.channelLabels.' . PiRelay::CHANNEL_4),
        ]) ?>
    </div>
    <div class="col-xs-4">
        <?= $this->Form->input('data.channelDurations.' . PiRelay::CHANNEL_4, [
            'type' => 'number',
            'label' => false,
            'value' => $this->Auth->user('data.channelDurations.' . PiRelay::CHANNEL_4),
            'append' => 'sek',
            'class' => 'duration-input'
        ]) ?>
    </div>
    <div class="col-xs-4">
        <div class="channel-link btn btn-default" data-channel="<?= PiRelay::CHANNEL_4 ?>">öffnen</div>
    </div>
</div>
<?= $this->Form->end() ?>


<div class="channel-action-list">

</div>
