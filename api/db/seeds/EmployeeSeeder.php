<?php


use Phinx\Seed\AbstractSeed;

class EmployeeSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'first_name' => 'Nils',
                'last_name' => 'Zühl'
            ],
            [
                'first_name' => 'Max',
                'last_name' => 'Becker'
            ],
            [
                'first_name' => 'Thomas',
                'last_name' => 'Monzel'
            ]
        ];

        $employees = $this->table('employees');
        $employees->insert($data)->save();
    }
}
