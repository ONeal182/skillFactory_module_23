<?

$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

function getFullnameFromParts($Surname, $first_name,$last_name){
    return $Surname.' '.$first_name.' '.$last_name;
}
$fullName = getFullnameFromParts('Иванов', 'Иван','Иваныч');
echo $fullName;
echo '<br>';
function getPartsFromFullname($fullName){
    $arrayName = explode(" ", $fullName);
    $arrayName = ['surname'=>$arrayName[0],'name'=>$arrayName[1],'patronomyc'=>$arrayName[2]];
    return $arrayName;
}
print_r(getPartsFromFullname($fullName));
echo '<br>';

function getShortName($fullName){
    $arrName =  getPartsFromFullname($fullName);

    return $arrName['name']. ' '.mb_substr($arrName['surname'], 0,1).'.';
}
echo getShortName($fullName);
echo '<br>';

function getGenderFromName($fullNameArray){
    $surname =$fullNameArray['surname'];
    $name = $fullNameArray['name'];
    $patronomyc = $fullNameArray['patronomyc'];
    $gender = 0;

    if(mb_substr($surname, -1) == 'в'){
        $gender = $gender + 1;
        
    }elseif(mb_substr($surname, -2) == 'ва'){
        $gender = $gender - 1;
    }

    if(mb_substr($name, -1) == 'й' || mb_substr($name, -1) == 'н'){
        $gender = $gender + 1;
        
    }elseif(mb_substr($name, -1) == 'а'){
        $gender = $gender - 1;
    }

    if(mb_substr($patronomyc, -2) == 'ич'){
        $gender = $gender + 1;

    }elseif(mb_substr($patronomyc, -3) == 'вна'){
        $gender = $gender - 1;
    }
    if($gender > 0 ){
        return 'мужской пол';
    }elseif($gender < 0){
        return 'женский пол';
    }else{
        return 'неопределенный пол';
    }

}
echo  getGenderFromName(getPartsFromFullname($fullName));
echo '<br>';

function getGenderDescription($example_persons_array){
    $male = 0;
    $female = 0;
    $errorName = 0;
    $count = count($example_persons_array);
    foreach($example_persons_array as $key=>$value){
        $fullNameArray = getPartsFromFullname($value['fullname']);
        if(getGenderFromName($fullNameArray) == 'мужской пол'){
            $male = $male +1;
        }elseif(getGenderFromName($fullNameArray) == 'женский пол'){
            $female = $female + 1;
        }else{
            $errorName = $errorName + 1;
        }
        
    }
    $malePersent = ($male / $count) * 100;
    $femalePersent = ($female / $count) * 100;
    $errorNamePersent = ($errorName / $count) * 100;
    $allPersent = 
    '
    Гендерный состав аудитории: <br>
    --------------------------- <br>
    Мужчины - '.round($malePersent,1).'% <br>
    Женщины - '.round($femalePersent,1).'% <br>
    Не удалось определить - '.round($errorNamePersent,1).'% <br>
    ';
    return $allPersent;


}
echo getGenderDescription($example_persons_array);