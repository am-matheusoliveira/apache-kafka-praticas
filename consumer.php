<?php
$conf = new RdKafka\Conf();
$conf->set('group.id', 'meuGrupo');
$conf->set('metadata.broker.list', 'kafka:9092');

$consumer = new RdKafka\KafkaConsumer($conf);
$consumer->subscribe(["ola_mundo"]);

echo "Aguardando mensagem...\n";

while (true) {
    $message = $consumer->consume(120*1000);
    switch ($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            echo "Mensagem recebida: ", $message->payload, "\n";
            break;
        case RD_KAFKA_RESP_ERR__PARTITION_EOF:
            echo "Fim da partição\n";
            break;
        case RD_KAFKA_RESP_ERR__TIMED_OUT:
            echo "Tempo de espera excedido\n";
            break;
        default:
            echo "Erro: ", $message->errstr(), "\n";
            break;
    }
}
?>
