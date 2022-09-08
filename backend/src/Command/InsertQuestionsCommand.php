<?php

namespace App\Command;

use App\Entity\TurboQuestion;
use App\Repository\TurboQuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class InsertQuestionsCommand extends Command
{
    public function __construct(private readonly TurboQuestionRepository $questionRepository, private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    private function createQuestion(
        string $stringQuestion,
        string $difficulty,
        string $category,
        string $firstWrongAnswer,
        string $secondWrongAnswer,
        string $thirdWrongAnswer,
        string $correctAnswer
    ): TurboQuestion
    {
        $question = new TurboQuestion();
        $question->setQuestion($stringQuestion);
        $question->setDifficulty($difficulty);
        $question->setCategory($category);
        $question->setFirstWrongAnswer($firstWrongAnswer);
        $question->setSecondWrongAnswer($secondWrongAnswer);
        $question->setThirdWrongAnswer($thirdWrongAnswer);
        $question->setCorrectAnswer($correctAnswer);

        return $question;
    }

    protected function configure()
    {
        $this
            ->setName('questions:insert')
            ->setDescription('This will insert all questions')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $question = $this->createQuestion(
            'Woran wird Hubraum gemessen?',
            'leicht',
            'Motor',
            'Kraft',
            'Masse',
            'Gewicht',
            'Volumen');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wie viele Zylinder hat ein V6 Motor mehr als ein R5 Motor?',
            'leicht',
            'Motor',
            '6',
            '0',
            '5',
            '1');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welche der folgenden Marken gehört nicht zur VW Group?',
            'mittel',
            'Marken',
            'Bentley',
            'Bugatti',
            'Lamborghini',
            'RollsRoyce');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welche der folgenden Marken gehört nicht zu Stellantis?',
            'schwer',
            'Marken',
            'Maserati',
            'Opel',
            'Fiat',
            'Ferrari');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wofür steht das R auf dem Reifen?',
            'leicht',
            'StVO',
            'Rennsportgeeignet',
            'dort steht kein R',
            'Rund',
            'radial');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welcher Geschwindigkeitsindex darf bis zu 300km/h fahren?',
            'schwer',
            'StVO',
            'V-Index',
            'W-Index',
            'H-Index',
            'Y-Index');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Was ist eine Eigenschaft von Diesel Kraftstoff?',
            'leicht',
            'Motor',
            'ist umweltfreundlicher als Benzin',
            'ist schwarz',
            'enthält Ingwer',
            'brennt nicht');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welche Zuordnung ist richtig?',
            'mittel',
            'Technik',
            'Ampere - Stromspannung',
            'Volt - Stromstärke',
            'Druck - Ohm',
            'Drehmoment - Newtonmeter');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wie hoch ist die Säuredichte einer vollständig geladenen Batterie?',
            'schwer',
            'Technik',
            '1,17 g/cm³',
            '124 g/cm³',
            '0,15 g/cm³',
            '1,28 g/cm³');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welche Farbe hat eine 15A Stecksicherung?',
            'schwer',
            'Technik',
            'Rot',
            'Gelb',
            'Orange',
            'Blau');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welche Arbeiten werden üblicherweise bei einer kleinen Inspektion durchgeführt?',
            'leicht',
            'Motor',
            'Zündkerzenwechsel',
            'Wechsel des Zahnriemens',
            'Getriebeölwechsel',
            'Ölwechsel');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welches System verhindert das Durchdrehen der Räder beim Beshcleunigen auf glattem Grund (z.B. auf glatter Fahrbahn und Schnee)?',
            'mittel',
            'Technik',
            'RDKS',
            'ESP',
            'ABS',
            'ASR');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Was ist die Gesetzliche Höchstgeschwindigkeit auf einer Kraftfahrtstraße, wenn es einen befestigten Mittelstreifen und zwei Fahrspuren pro Richtung gibt?',
            'leicht',
            'StVO',
            '130 km/h',
            '100 km/h',
            'Unbegrenzt',
            '120 km/h');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wie schnell entfaltet sich ein Airbag?',
            'mittel',
            'Technik',
            '10 Millisekunden',
            '270 bis 300 Millisekunden',
            '100 Millisekunden',
            '30 bis 60 Millisekunden');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wie gering muss die Sichtweite sein, damit man die Nebelschlussleuchte einschalten darf?',
            'mittel',
            'StVO',
            '40 Meter',
            '60 Meter',
            '150 Meter',
            '100 Meter');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Warum werden kaum/keine Wankelmotoren mehr gebaut?',
            'leicht',
            'Motor',
            'zu wenig Leistung',
            'Brandgefahr',
            'zu hoher Verbrauch',
            'geringe Lebensdauer');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welche drei Automarken haben 2021 die meisten Autos hergestellt?',
            'mittel',
            'Marken',
            'VW, BMW und Mercedes',
            'VW, Stellantis und Nissan',
            'Mercedes, BMW und Toyota',
            'Toyota, VW und Hyundai');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wi fundest du die empfohlene Bar Zahl deiner Reifen im Normalfall?',
            'leicht',
            'Technik',
            'Im Fahrzeugbrief',
            'Unter der Motorhaube',
            'Im Tankdeckel',
            'In der Tür');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wofür steht die Abkürzung SUV?',
            'mittel',
            'Technik',
            'Surround Underground Vehicle',
            'Stable Upward Vehicle',
            'Stable Utility Vehicle',
            'Sports Utility Vehicle');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wie viele Zylinder hat der klassische Boxermotor von Porsche?',
            'leicht',
            'Motor',
            '8',
            '5',
            '10',
            '6');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Was ist das Firmenlogo von Maserati?',
            'leicht',
            'Marken',
            'Ein Blitz',
            'Ein Pferd',
            'Ein Stier',
            'Ein Dreizack');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wofür steht MAN?',
            'leicht',
            'Marken',
            'Maschienenfabrik für Autos aus den Niederlanden',
            'Motoren aus den Niederlanden',
            'Münchener Autos und Nutzfahrzeuge',
            'Maschienenfabrik Augsburg Nürnberg');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wann wurde die Auto Fahrerlaubnis eingeführt?',
            'mittel',
            'Wer, wann und wo?',
            '1903',
            '1897',
            '1909',
            '1888');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Kia Motors stammt aus ...?',
            'mittel',
            'Marken',
            '... den USA',
            '... Italien',
            '... Deutschland',
            '... Korea');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welche ?',
            'schwer',
            'Marken',
            'Rot',
            'Gelb',
            'Orange',
            'Blau');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Was bedeutet DSG?',
            'leicht',
            'Technik',
            'Deutsches Sicherheits Gesetz',
            'Die Spaß-Garantie',
            'Detsche Sicherheits Garantie',
            'Direktschaltgetriebe');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Was soll der BMW-Kühlergrill symbolisieren?',
            'leicht',
            'Marken',
            'Münchener Weißwürste',
            'Ein Gehirn',
            'Eine Brezel',
            'Eine Niere');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wann fand das erste Grand-Prix-Autorennen statt?',
            'mittel',
            'Wer, wann und wo?',
            '1909',
            '1901',
            '1899',
            '1906');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Der Spitzname des Citroen DS war?',
            'leicht',
            'Marken',
            'Königin',
            'Held',
            'Gott',
            'Göttin');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wie viele Zylinder hat der Motor des Smart ForTwo?',
            'mittel',
            'Motor',
            '1',
            '2',
            '4',
            '3');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wie lautet die deutsche Übersetzung von Volvo?',
            'mittel',
            'Marken',
            'Ich fahre',
            'Ich bewege mich',
            'Ich fliege',
            'Ich rolle');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Ein KiloWatt entspricht wie vielen PS?',
            'mittel',
            'Technik',
            '0,85',
            '1,44',
            '0,92',
            '1,36');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Ab welcher Temperatur ist Dieselkraftstoff nichtmehr gebrauchsfähig?',
            'leicht',
            'Motor',
            'minus 10 Grad Celsius',
            'null Grad Celsius',
            'minus 30 Grad Celsius',
            'minus 20 Grad Celsius');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Welche Farbe hatte das Autolicht in Frankreich früher?',
            'leicht',
            'Technik',
            'Weiß',
            'Ultraviolett',
            'Blau',
            'Gelb');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wie heißt die Kühlerfigur von RollsRoyce?',
            'mittel',
            'Marken',
            'Elli',
            'Entity',
            'Dorothy',
            'Emily');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wie viel PS hat ein Pferd?',
            'mittel',
            'Technik',
            '1',
            '129',
            '7',
            '24');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wer hat den Dieselmotor erfunden?',
            'mittel',
            'Wer, wann und wo?',
            'Robin Diesel',
            'Ralf Diesel',
            'Richard Diesel',
            'Rudolf Diesel');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Was ist ein Selbstzünder?',
            'mittel',
            'Motor',
            'Auspuffanlage',
            'Vergaser Vorwärmer',
            'Ein bestimmtes Öl',
            'Diesel-Motor');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Der VW Käfer wurde von 1938 bis zu welchem Jahr produziert?',
            'mittel',
            'Wer, wann und wo?',
            '2022',
            '1991',
            '1984',
            '2003');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Was hat Opel zuerst hergestellt?',
            'mittel',
            'Marken',
            'Flugzeugmotoren',
            'Schiffsmotoren',
            'Haushaltsgeräte',
            'Nähmaschienen');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wo hat Ferrari seinen Hauptsitz?',
            'mittel',
            'Wer, wann und wo?',
            'San Marino',
            'Bologna',
            'Mailand',
            'Modena');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Audi ist die lateinische Übersetzung von...?',
            'leicht',
            'Marken',
            'Schau!',
            'Denke!',
            'Renn!',
            'Horch!');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wo ist die gläserne Manufaktur von VW?',
            'mittel',
            'Wer, wann und wo?',
            'Wolfsburg',
            'Leipzig',
            'Nürnberg',
            'Dresden');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Wer erfand den Kreiskolbenmotor?',
            'leicht',
            'Wer, wann und wo?',
            'Gottfried Daimler',
            'Karl Benz',
            'Nicola Tesla',
            'Felix Wankel');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Der Citroen 2CV ist auch bekannt als ...?',
            'leicht',
            'Marken',
            '... Käfer',
            '... Flieger',
            '... Fuchs',
            '... Ente');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Ein Targadach ist ...?',
            'leicht',
            'Technik',
            '... transparent',
            '... aus Stoff',
            '... ein Solardach',
            '... abnehmbar');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Aus welchem Jahr stammt das erste Elektroauto?',
            'mittel',
            'Wer, wann und wo?',
            '1939',
            '1989',
            '1991',
            '1881');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Was bedeutet das "E" am Ende eines Kennzeichens?',
            'leicht',
            'StVO',
            'Energieeffizient',
            'Elchtest bestanden',
            '100% Ethanol betrieben',
            'Elektro-/Plugin-Hybrid-Fahrzeug');
        $this->questionRepository->createQuestion($question);

        $question = $this->createQuestion(
            'Nach der ACEA-Klassifikation beschreibt welche Klasse Motorenöle für Dieselmotoren mit Partikelfilter?',
            'schwer',
            'Technik',
            'Klasse A',
            'Klasse B',
            'Klasse D',
            'Klasse C');
        $this->questionRepository->createQuestion($question);
        $question = $this->createQuestion(
            'Welches Bauteil hat ein KFZ mit Frontantrieb nicht?',
            'mittel',
            'Technik',
            'Nockenwelle',
            'Kurbelwelle',
            'Ladeluftkühler',
            'Kardanwelle');
        $this->questionRepository->createQuestion($question);
        $question = $this->createQuestion(
            'Was versteht man unter Lambda 1?',
            'schwer',
            'Motor',
            'Stromstärke auf der Lambdasonde',
            'Stromspannung auf der Lambdasonde',
            'Die Perfekte Spannung in der H2 Lampe',
            'Das optimale Luft-/Kraftstoffgemisch');
        $this->questionRepository->createQuestion($question);
        $question = $this->createQuestion(
            'Wie hoch ist das Luft-/Kraftstoff Gemisch bei Lambda1?',
            'schwer',
            'Technik',
            '1,2:1,9',
            '16,2:1',
            '1:1',
            '14,7:1');
        $this->questionRepository->createQuestion($question);
        $question = $this->createQuestion(
            'Wie kann ich rechtzeitig erkennen, dass meine Bremsen verschlissen sind?',
            'mittel',
            'Technik',
            'Wenn meine Bremsen nichtmehr funktionieren',
            'Wenn meine Bremsflüssigkeit leer ist',
            'Wenn das Auto nichtmehr beschleunigt',
            'Akustische Signale durch den Bremsbelag');
        $this->questionRepository->createQuestion($question);
        $question = $this->createQuestion(
            'Welche Aufgabe hat das Ausrücklager bei einer Kupplung?',
            'schwer',
            'Technik',
            'Kühlt bei übermäßigem Verschleiß die Kupplung',
            'Hilft beim Tausch einer defekten Kupplung',
            'Warnt den Fahrer bei übermäßigem Verschleiß',
            'Ermöglicht Ein-/Auskuppeln');
        $this->questionRepository->createQuestion($question);
        $question = $this->createQuestion(
            'Was für ein Automatikgetriebe hat ein Audi R8 von 2010?',
            'schwer',
            'Technik',
            'Wandlerautomatik',
            'DSG',
            'CVT',
            'Automatisiertes Schaltgetriebe (Smart-Getriebe)');
        $this->questionRepository->createQuestion($question);
        $question = $this->createQuestion(
            'Welches Szenario kommt der Funktion einer Wandlerautomatik am nächsten?',
            'schwer',
            'Technik',
            'Trinken durch einen Strohhalm',
            'Thermomix',
            'Glas Wasser',
            'Salatschleuder');
        $this->questionRepository->createQuestion($question);

        $this->entityManager->flush();

        $io = new SymfonyStyle($input, $output);
        $io->success('Data inserted!');

        return Command::SUCCESS;
    }
}