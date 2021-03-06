<?php

namespace Equip\Project\Domain;

use Equip\Adr\DomainInterface;
use Equip\Adr\PayloadInterface;

class EmployeeShifts implements DomainInterface
{
    /**
     * @var PayloadInterface
     */
    private $payload;

    /**
     * @param PayloadInterface $payload
     */
    public function __construct(PayloadInterface $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(array $input)
    {
        $employeeId = $input['id'];

        return $this->payload
            ->withStatus(PayloadInterface::OK)
            ->withOutput([
                'employee' => $employeeId,
                'shifts' => [],
            ]);
    }
}
