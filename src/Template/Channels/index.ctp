<?php
    use WolfgangBraun\PiRelay\PiRelay;
?>

<pre>
<?php
    var_dump($states);
?>
<?= $this->Html->link('1 an', [
    'action' => 'setState',
    PiRelay::CHANNEL_1,
    PiRelay::STATE_ON
]) ?><br>
<?= $this->Html->link('1 aus', [
    'action' => 'setState',
    PiRelay::CHANNEL_1,
    PiRelay::STATE_OFF
]) ?><br>
<?= $this->Html->link('2 an', [
    'action' => 'setState',
    PiRelay::CHANNEL_2,
    PiRelay::STATE_ON
]) ?><br>
<?= $this->Html->link('2 aus', [
    'action' => 'setState',
    PiRelay::CHANNEL_2,
    PiRelay::STATE_OFF
]) ?><br>
<?= $this->Html->link('3 an', [
    'action' => 'setState',
    PiRelay::CHANNEL_3,
    PiRelay::STATE_ON
]) ?><br>
<?= $this->Html->link('3 aus', [
    'action' => 'setState',
    PiRelay::CHANNEL_3,
    PiRelay::STATE_OFF
]) ?><br>
<?= $this->Html->link('4 an', [
    'action' => 'setState',
    PiRelay::CHANNEL_4,
    PiRelay::STATE_ON
]) ?><br>
<?= $this->Html->link('4 aus', [
    'action' => 'setState',
    PiRelay::CHANNEL_4,
    PiRelay::STATE_OFF
]) ?><br>