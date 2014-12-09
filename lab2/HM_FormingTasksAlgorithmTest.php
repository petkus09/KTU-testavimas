<?php


class FormingTasksAlgorithmTest extends PHPUnit_Framework_TestCase {

    protected $gContainers;
    private $db;

    function __construct()
    {
        require_once('../../_init.php');
        $this->gSwapContainerAlgorithm =& load_class('SwapContainerAlgorithm');
        $this->db =& load_class('DB');
    }

    /**
     * @covers HM_SwapContainerAlgorithm
     */
    public function testSingleContainerMovement()
    {
        $post = array();
        $post['columns']['1-A-1']['Coordinates']['1']['1']['ID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['column'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Y'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['column'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Y'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Name'] = 'column-1-A-2';
        $post['columns']['1-A-1']['blockID'] = '1';
        $post['columns']['1-A-1']['row'] = 'A';
        $post['columns']['1-A-1']['column'] = '1';
        $post['columns']['1-A-1']['Name'] = '1-A-1';
        $post['columns']['1-A-2']['blockID'] = '1';
        $post['columns']['1-A-2']['row'] = 'A';
        $post['columns']['1-A-2']['column'] = '2';
        $post['columns']['1-A-2']['Name'] = '1-A-2';

        $expResult = array();
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 1;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;

        $realResult = $this->gSwapContainerAlgorithm->swapContainerAlgorithm($post['columns']);
        $this->assertEquals($expResult, $realResult);
    }

    /**
     * @covers HM_SwapContainerAlgorithm
     */
    public function testMoveFullyLoadedContainerColumnToAnotherSpot()
    {

        $post = array();
        $post['columns']['1-A-1']['Coordinates']['1']['1']['ID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['column'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Y'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['column'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Y'] = '3';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Name'] = 'column-1-A-2';

        $post['columns']['1-A-1']['Coordinates']['1']['2']['ID'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['column'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['Y'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['to']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['to']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['to']['column'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['to']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['to']['Y'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['to']['Name'] = 'column-1-A-2';

        $post['columns']['1-A-1']['Coordinates']['1']['3']['ID'] = '3';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['column'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['Y'] = '3';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['to']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['to']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['to']['column'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['to']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['to']['Y'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['to']['Name'] = 'column-1-A-2';

        $post['columns']['1-A-1']['blockID'] = '1';
        $post['columns']['1-A-1']['row'] = 'A';
        $post['columns']['1-A-1']['column'] = '1';
        $post['columns']['1-A-1']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-2']['blockID'] = '1';
        $post['columns']['1-A-2']['row'] = 'A';
        $post['columns']['1-A-2']['column'] = '2';
        $post['columns']['1-A-2']['Name'] = 'column-1-A-2';

        $expResult = array();
        $expResulttemp = array();
            $expResulttemp['ContainerID'] = 3;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'3','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
        $expResulttemp = array();
            $expResulttemp['ContainerID'] = 2;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'2','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'2','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
        $expResulttemp = array();
            $expResulttemp['ContainerID'] = 1;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'3','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;

        $realResult = $this->gSwapContainerAlgorithm->swapContainerAlgorithm($post['columns']);
        $this->assertEquals($expResult, $realResult);
    }

    public function testBuildingFullContainerColumnOutOf3Columns()
    {
        $post = array();
        $post['columns']['1-A-1']['Coordinates']['1']['1']['ID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['column'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Y'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['column'] = '4';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Y'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Name'] = 'column-1-A-4';

        $post['columns']['1-A-2']['Coordinates']['1']['1']['ID'] = '2';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['blockID'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['row'] = 'A';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['column'] = '2';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['X'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['Y'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['Name'] = 'column-1-A-2';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['blockID'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['row'] = 'A';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['column'] = '4';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['X'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['Y'] = '3';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['Name'] = 'column-1-A-4';

        $post['columns']['1-A-3']['Coordinates']['1']['1']['ID'] = '3';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['from']['blockID'] = '1';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['from']['row'] = 'A';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['from']['column'] = '3';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-3']['Coordinates']['1']['1']['from']['X'] = '1';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['from']['Y'] = '1';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['from']['Name'] = 'column-1-A-3';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['to']['blockID'] = '1';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['to']['row'] = 'A';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['to']['column'] = '4';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['to']['X'] = '1';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['to']['Y'] = '1';
        $post['columns']['1-A-3']['Coordinates']['1']['1']['to']['Name'] = 'column-1-A-4';

        $post['columns']['1-A-1']['blockID'] = '1';
        $post['columns']['1-A-1']['row'] = 'A';
        $post['columns']['1-A-1']['column'] = '1';
        $post['columns']['1-A-1']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-2']['blockID'] = '1';
        $post['columns']['1-A-2']['row'] = 'A';
        $post['columns']['1-A-2']['column'] = '2';
        $post['columns']['1-A-2']['Name'] = 'column-1-A-2';
        $post['columns']['1-A-3']['blockID'] = '1';
        $post['columns']['1-A-3']['row'] = 'A';
        $post['columns']['1-A-3']['column'] = '3';
        $post['columns']['1-A-3']['Name'] = 'column-1-A-3';
        $post['columns']['1-A-4']['blockID'] = '1';
        $post['columns']['1-A-4']['row'] = 'A';
        $post['columns']['1-A-4']['column'] = '4';
        $post['columns']['1-A-4']['Name'] = 'column-1-A-4';

        $expResult = array();
        $expResulttemp = array();
        $expResulttemp['ContainerID'] = 3;
        $expResulttemp['from'] = array('blockID'=>'1','column'=>'3','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResulttemp['to'] = array('blockID'=>'1','column'=>'4','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
        $expResulttemp = array();
        $expResulttemp['ContainerID'] = 1;
        $expResulttemp['from'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResulttemp['to'] = array('blockID'=>'1','column'=>'4','row'=>'A','level'=>'2','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
        $expResulttemp = array();
        $expResulttemp['ContainerID'] = 2;
        $expResulttemp['from'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResulttemp['to'] = array('blockID'=>'1','column'=>'4','row'=>'A','level'=>'3','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;

        $realResult = $this->gSwapContainerAlgorithm->swapContainerAlgorithm($post['columns']);
        $this->assertEquals($expResult, $realResult);
    }

    public function testContainerSwappingWithEachOther()
    {
        $post = array();
        $post['columns']['1-A-1']['Coordinates']['1']['1']['ID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['column'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Y'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['column'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Y'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Name'] = 'column-1-A-2';

        $post['columns']['1-A-2']['Coordinates']['1']['1']['ID'] = '2';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['blockID'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['row'] = 'A';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['column'] = '2';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['X'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['Y'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['Name'] = 'column-1-A-2';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['blockID'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['row'] = 'A';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['column'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['X'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['Y'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['Name'] = 'column-1-A-1';

        $post['columns']['1-A-1']['blockID'] = '1';
        $post['columns']['1-A-1']['row'] = 'A';
        $post['columns']['1-A-1']['column'] = '1';
        $post['columns']['1-A-1']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-2']['blockID'] = '1';
        $post['columns']['1-A-2']['row'] = 'A';
        $post['columns']['1-A-2']['column'] = '2';
        $post['columns']['1-A-2']['Name'] = 'column-1-A-2';

        $expResult = array();
        $expResulttemp = array();
        $expResulttemp['ContainerID'] = 1;
        $expResulttemp['from'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResulttemp['to'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
        $expResult[] = $expResulttemp;
        $expResulttemp = array();
        $expResulttemp['ContainerID'] = 2;
        $expResulttemp['from'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResulttemp['to'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
        $expResulttemp = array();
        $expResulttemp['ContainerID'] = 1;
        $expResulttemp['from'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
        $expResulttemp['to'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;

        $realResult = $this->gSwapContainerAlgorithm->swapContainerAlgorithm($post['columns']);
        $this->assertEquals($expResult, $realResult);
    }

    public function testColumnShuffle()
    {
        $post = array();
        $post['columns']['1-A-1']['Coordinates']['1']['1']['ID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['column'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Y'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['from']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['column'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Y'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['1']['to']['Name'] = 'column-1-A-2';

        $post['columns']['1-A-1']['Coordinates']['1']['2']['ID'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['column'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['Y'] = '2';
        $post['columns']['1-A-1']['Coordinates']['1']['2']['from']['Name'] = 'column-1-A-1';

        $post['columns']['1-A-1']['Coordinates']['1']['3']['ID'] = '3';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['blockID'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['row'] = 'A';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['column'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['X'] = '1';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['Y'] = '3';
        $post['columns']['1-A-1']['Coordinates']['1']['3']['from']['Name'] = 'column-1-A-1';

        $post['columns']['1-A-2']['Coordinates']['1']['1']['ID'] = '4';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['blockID'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['row'] = 'A';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['column'] = '2';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['X'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['Y'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['from']['Name'] = 'column-1-A-2';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['blockID'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['row'] = 'A';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['column'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['X'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['Y'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['1']['to']['Name'] = 'column-1-A-1';

        $post['columns']['1-A-2']['Coordinates']['1']['2']['ID'] = '5';
        $post['columns']['1-A-2']['Coordinates']['1']['2']['from']['blockID'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['2']['from']['row'] = 'A';
        $post['columns']['1-A-2']['Coordinates']['1']['2']['from']['column'] = '2';
        $post['columns']['1-A-2']['Coordinates']['1']['2']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-2']['Coordinates']['1']['2']['from']['X'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['2']['from']['Y'] = '2';
        $post['columns']['1-A-2']['Coordinates']['1']['2']['from']['Name'] = 'column-1-A-2';

        $post['columns']['1-A-2']['Coordinates']['1']['3']['ID'] = '6';
        $post['columns']['1-A-2']['Coordinates']['1']['3']['from']['blockID'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['3']['from']['row'] = 'A';
        $post['columns']['1-A-2']['Coordinates']['1']['3']['from']['column'] = '2';
        $post['columns']['1-A-2']['Coordinates']['1']['3']['from']['blockParkingSpotID'] = null;
        $post['columns']['1-A-2']['Coordinates']['1']['3']['from']['X'] = '1';
        $post['columns']['1-A-2']['Coordinates']['1']['3']['from']['Y'] = '3';
        $post['columns']['1-A-2']['Coordinates']['1']['3']['from']['Name'] = 'column-1-A-2';

        $post['columns']['1-A-1']['blockID'] = '1';
        $post['columns']['1-A-1']['row'] = 'A';
        $post['columns']['1-A-1']['column'] = '1';
        $post['columns']['1-A-1']['Name'] = 'column-1-A-1';
        $post['columns']['1-A-2']['blockID'] = '1';
        $post['columns']['1-A-2']['row'] = 'A';
        $post['columns']['1-A-2']['column'] = '2';
        $post['columns']['1-A-2']['Name'] = 'column-1-A-2';

        $expResult = array();
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 3;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'3','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 2;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'2','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 1;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 6;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'3','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 5;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'2','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 4;
            $expResulttemp['from'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 2;
            $expResulttemp['from'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'2','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 3;
            $expResulttemp['from'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'1','row'=>'A','level'=>'3','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 1;
            $expResulttemp['from'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'1','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 5;
            $expResulttemp['from'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'2','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;
            $expResulttemp = array();
            $expResulttemp['ContainerID'] = 6;
            $expResulttemp['from'] = array('blockID'=>'temp','column'=>'temp','row'=>'temp','level'=>'temp','truckID'=>'temp','placeInHolder'=>'temp','transportType'=>'temp','blockParkingSpotID'=>'temp');
            $expResulttemp['to'] = array('blockID'=>'1','column'=>'2','row'=>'A','level'=>'3','truckID'=>null,'placeInHolder'=>'1','transportType'=>null,'blockParkingSpotID'=>null);
        $expResult[] = $expResulttemp;

        $realResult = $this->gSwapContainerAlgorithm->swapContainerAlgorithm($post['columns']);
        $this->assertEquals($expResult, $realResult);
    }


}
 