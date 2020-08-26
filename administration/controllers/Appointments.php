<?php

namespace App\controllers;

class Appointments
{
    /**
     * Récupère les rendez-vous commençant entre 2 dates
     * @param \DateTime $start
     * @param \DateTime $end
     * return array
     */
    public function getEventsBetween(\DateTime $start, \DateTime $end): array
    {
        $pdo = new \PDO(
            'mysql:host=localhost;dbname=xiaoyu;charset=utf8',
            'root',
            '',
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]
        );
        $sql = "SELECT * 
                FROM appointments
                WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ";
        $statement = $pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }
      /**
     * Récupère les rendez-vous commençant entre 2 dates indexé par jour
     * @param \DateTime $start
     * @param \DateTime $end
     * return array
     */
    public function getEventsBetweenByDay(\DateTime $start, \DateTime $end): array{
        $appointments = $this->getEventsBetween($start, $end);
        $days = [];
        foreach($appointments as $appointment){
            $date = explode('', $appointment['start'])[0];
            if (!isset($days[$date])){
                $days[$date] = [$appointment];
            }else{
                $days[$date][] = $appointment;
            }
        }
        return $days;
    }
}
