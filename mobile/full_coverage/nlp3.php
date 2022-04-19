<?php
include('vendor/autoload.php');
 
use NlpTools\Documents\DocumentInterface;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use NlpTools\FeatureFactories\FunctionFeatures;
use NlpTools\Analysis\Idf;
 
class TfIdfFeatureFactory extends FunctionFeatures
{
    protected $idf;
 
    public function __construct(Idf $idf, array $functions)
    {
        parent::__construct($functions);
        $this->modelFrequency();
        $this->idf = $idf;
    }
 
    public function getFeatureArray($class, DocumentInterface $doc)
    {
        $frequencies = parent::getFeatureArray($class, $doc);
        foreach ($frequencies as $term=>&$value) {
            $value = $value*$this->idf[$term];
        }
        return $frequencies;
    }
}
 
$tset = new TrainingSet();
$tset->addDocument(
    "",
    new TokensDocument(
        explode(
            " ",
            "Don't go around saying the world owes you a living . The world owes you nothing . It was here first ."
        )
    )
);
$tset->addDocument(
    "",
    new TokensDocument(
        explode(
            " ",
            "Go to Heaven for the climate , Hell for the company ."
        )
    )
);
$tset->addDocument(
    "",
    new TokensDocument(
        explode(
            " ",
            "If you tell the truth , you don't have to remember anything ."
        )
    )
);
 
$idf = new Idf($tset);
$ff = new TfIdfFeatureFactory(
    $idf,
    array(
        function ($c, $d) {
            return $d->getDocumentData();
        }
    )
);
 
print_r($ff->getFeatureArray("", $tset[0]));
 

?>