<?php
    
    $conf = new RdKafka\Conf();
    $conf->set('metadata.broker.list', 'kafka:9092');

    $producer = new RdKafka\Producer($conf);
    $topic = $producer->newTopic("ola_mundo");

    $message = "Olá, Mundo!";
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);

    echo "Mensagem enviada: $message\n";
    $producer->poll(0);

    // Aguarde o envio da mensagem
    while ($producer->getOutQLen() > 0) {
        $producer->poll(50);
    }

?>