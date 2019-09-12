<?php

namespace App\Console;

use PDO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command.
 */
final class SchemaSqlCommand extends Command
{

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * Constructor.
     *
     * @param PDO $pdo The connection
     * @param string|null $name The name
     */
    public function __construct(PDO $pdo, ?string $name = null)
    {
        parent::__construct($name);
        $this->pdo =$pdo;
    }

    /**
     * Configure.
     *
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName('update-schema-sql');
        $this->setDescription('Generate a schema.sql from the schema data source.');
    }

    /**
     * Execute command.
     *
     * @param InputInterface $input The input
     * @param OutputInterface $output The output
     *
     * @return int The error code, 0 on success
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(sprintf('Use database: %s', $this->pdo->query('select database()')->fetchColumn()));

        $statement = $this->pdo->query('SELECT table_name
                FROM information_schema.tables
                WHERE table_schema = database()');

        $sql = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $statement2 = $this->pdo->query(sprintf('SHOW CREATE TABLE `%s`;', $row['table_name']));
            $sql[] = $statement2->fetch()['Create Table'] . ';';
        }

        $sql = implode("\n\n", $sql);

        $filename = __DIR__ . '/../../resources/migrations/schema.sql';
        file_put_contents($filename, $sql);

        $output->writeln(sprintf('Generated file: %s', realpath($filename)));
        $output->writeln(sprintf('<info>Done</info>'));

        return 0;
    }
}
