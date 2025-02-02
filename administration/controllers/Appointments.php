<?php

namespace controllers;


class Appointments
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    /**
     * Récupère les rendez-vous commençant entre 2 dates
     * @param \DateTime $start
     * @param \DateTime $end
     * return array
     */
    public function getAppointmentsBetween(\DateTime $start, \DateTime $end): array
    {
        $sql = "SELECT * 
                FROM appointments
                WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }
    /**
     * Récupère les rendez-vous commençant entre 2 dates indexées par jour
     * @param \DateTime $start
     * @param \DateTime $end
     * return array
     */
    public function getAppointmentsBetweenByDay(\DateTime $start, \DateTime $end): array
    {
        $appointments = $this->getAppointmentsBetween($start, $end);
        $days = [];
        foreach ($appointments as $appointment) {
            $date = explode(' ', $appointment['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$appointment];
            } else {
                $days[$date][] = $appointment;
            }
        }
        return $days;
    }
    /**
     * Récupère un évènement
     * @param int $id
     * return Event
     * @return $result
     */
    public function find(int $id): Appointment
    {
        require '../controllers/Appointment.php';
        $statement = $this->pdo->query("SELECT * FROM appointments WHERE id = $id LIMIT 1");
        $statement ->setFetchMode(\PDO::FETCH_CLASS, Appointment::class);
        $result = $statement->fetch();
        if($result === false){
            throw new \Exception('Aucun résultat n\'a été trouvé');
        }
        return $result;
    }
    public function create(Appointment $appointment): bool{
        $statement = $this->pdo->prepare('INSERT INTO appointments (title, description, start, end) VALUES (?, ?, ?, ?)');
        return $statement->execute([
            $appointment->getTitle(),
            $appointment->getDescription(),
            $appointment->getStart()->format('Y-m-d H:i:s'),
            $appointment->getEnd()->format('Y-m-d H:i:s'),
        ]);
    }
}
