<?php
/**
 * Сервис отправки SMS
 */
class SmsPilotService extends CApplicationComponent
{
    public $apiKey;
    public $sender = 'INFORM';
    public $enabled = true;

    public function send(int $phone, string $text)
    {
        if (!$this->enabled) {
            Yii::log('SMS отключен', CLogger::LEVEL_INFO, 'sms');
            return ['success' => true];
        }

        $url = 'https://smspilot.ru/api.php?' . http_build_query([
                'send' => $text,
                'to' => $phone,
                'from' => $this->sender,
                'apikey' => $this->apiKey,
                'format' => 'json',
            ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            Yii::log("cURL ошибка: $error", CLogger::LEVEL_ERROR, 'sms');
            return false;
        }

        $data = json_decode($response, true);

        if (isset($data['error'])) {
            $msg =  $data['error']['description_ru'] ?? $data['error']['description'];
            Yii::log("SMS ошибка: $msg", CLogger::LEVEL_ERROR, 'sms');
            return false;
        }

        return $data;
    }
}
