<?php
/**
 * FileName: MongoUtils.php
 * Description: mongoDb Utils 操作类
 * Author: Bigpao
 * Email: bigpao.luo@gmail.com
 * HomePage: 
 * Version: 0.0.1
 * LastChange: 2015-04-05 17:26:59
 * History:
 */
class MongoUtils
{
    /**
     * mongo client Object
     */
    protected $mongoClient;

    /**
     * mongo DB Objcect
     */
    protected $mongoDB;

    /**
     * mongo collecton Object
     */
    protected $mongoCollection;


    /**
     * 构造方法
     * @param string $dns 连接uri
     * @param array $options 连接额外参数
     * @param string $database 连接数据库
     * @param string $collection 连接集合
     * @return null
     */
    public function __construct($dsn, $database = "", $collection = "", $options = array())
    {
        $this -> mongoClient = new MongoClient($dsn,$options);
        if($database != "")
            $this -> mongoDB = $this -> mongoClient -> selectDB($database);
        if($collection != "")
            $this -> mongoCollection = $this -> mongoDB -> selectCollection($collection);
    }


    /**
     * 设置mongodDB 对象
     * @param MongoDB对象
     * @return null
     */
    public function setMongoDB(MongoDB $mongoDb)
    {
        $this -> mongoDb = $mongoDb;
    }

    /**
     * 获取mongoDB对象
     * @return MongoDB对象
     */
    public function getMongoDB()
    {
        return $this -> mongoDB;
    }

    /**
     * 获取mongoClient
     */
    public function getMongoClient()
    {
        $this -> mongoClient;
    }

    /**
     * 设置MongoClient对象
     * @param MongoClient 对象
     * @return  null
     */
    public function setMongoClient(MongoClient $mongoClient)
    {
        $this -> mongoClient = $mongoClient;
    }

    /**
     * 根据条件查询1条记录
     * @param array $criteria
     * @return boolean | array 结果集
     */
    public function findOne($criteria)
    {
        return $this -> mongoCollection -> findOne($criteria);
    }

    /**
     * 跟新mongo记录
     * @param array $criteria 查询条件
     * @param array $newObj 需要更新的对象
     * @options array 更新的额外条件
     * @return obj
     */
    public function update($criteria, $newObj, $options = array())
    {
        $this -> checkCollection();
        return $this -> mongoCollection -> update($criteria, $newObj, $options);
    }


    /**
     * 查询并且修改对象
     * @param array $criteria 查村条件
     * @param array $update 需要修改的对象
     * @param array $field 需要修改的字段
     * @param array $options 额外条件
     * @return boolean | array
     */
    public function findAndModify($crteria, $update, $field, $options)
    {
        $this -> checkCollection();
        return $this -> mongoCollection -> findAndModify($crteria, $update, $field, $options);
    }

    /**
     * 向结果集插入数据
     * @param array $obj 需要插入的数据
     * @param array $options 额外条件
     * @return boolean | array  options设置了'w' 返回 array
     */
    public function insert($obj, $options = array())
    {
        $this -> checkCollection();
        $this -> mongoCollection -> insert($obj);
    }

    /**
     * 检查对象collection是否已经赋值了
     */
    protected function checkCollection()
    {
        if($this -> mongoCollection == null)
            throw new Exception('please select collection');
    }

    /**
     * 设置mongoCollection结果集合的名称
     * @param MongoCollection 对象
     * @reutrn null;
     */
    public function setCollection(MongoCollection $collection)
    {
        $this -> mongoCollection = $collection;
    }


    /**
     * 获取结果集合
     * @return MongoCollection 对象
     */
    public function getCollection()
    {
        return $this -> mongoCollection;
    }

    /**
     * 选择集合
     * @param string $collection 新的集合
     * @return MongoCollection 对象
     */
    public function selectCollection($collection)
    {
        return $this -> mongoDB -> selectCollection($collection);
    }
}
