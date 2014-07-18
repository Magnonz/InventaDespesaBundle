

//--------------------Filtro Supplier, Status e Countries-----------
/* $filtera = array(
  'supplier_id' => $filterform["supplier_id"]->getData(),
  'status' => $filterform["status"]->getData(),
  'countries' => $filterform["countries"]->getData(),
  );

  foreach($filtera as $filtro => $valor) {
  if($valor == NULL) {
  unset($filtera[$filtro]);
  }
  }

  if(!empty($filtera))
  {
  $em = $this->getDoctrine()->getManager();
  $entities = $em->getRepository('InventaDespesasBundle:Expenses')->findBy($filtera);

  }
  else
  {
  $em = $this->getDoctrine()->getManager();
  $entities = $em->getRepository('InventaDespesasBundle:Expenses')->findAll();
  } */


//------------------------------File Test-----------------------
/**
 * Get file.
 *
 * @return UploadedFile
 */
public function getFile()
{
return $this->file;
}
/**
 * Sets file.
 *
 * @param UploadedFile $file
 */
public function setFile(UploadedFile $file = null)
{
$this->file = $file;
// check if we have an old image path
if (isset($this->path)) {
// store the old name to delete after the update
$this->temp = $this->path;
$this->path = null;
} else {
$this->path = $this->file;
}

}
/**
 * @ORM\PrePersist()
 * @ORM\PreUpdate()
 */
public function preUpload()
{
if (null !== $this->getFile()) {
// do whatever you want to generate a unique name
$filename = sha1(uniqid(mt_rand(), true));
$this->path = $filename.'.'.$this->getFile()->guessExtension();
}
}

/**
 * @ORM\PostPersist()
 * @ORM\PostUpdate()
 */
public function upload()
{
if (null === $this->getFile()) {
return;
}

$this->getFile()->move($this->getUploadRootDir(), $this->path);

// check if we have an old image
if (isset($this->temp)) {
// delete the old image
unlink($this->getUploadRootDir().'/'.$this->temp);
// clear the temp image path
$this->temp = null;
}
//$this->file = null;
}


public function getAbsolutePath()
{
return null === $this->path
? null
: $this->getUploadRootDir().'/'.$this->path;
}

public function getWebPath()
{
return null === $this->path
? null
: $this->getUploadDir().'/'.$this->path;
}

protected function getUploadRootDir()
{
// the absolute directory path where uploaded
// documents should be saved
return __DIR__.'/../../../../web/expenses/files';
}


















     <nav class="navbar navbar-inverse " role="navigation" >
        <div class="container-fluid">
   
        <div class="navbar-header">
        <ul class="nav navbar-nav">
            <li class="navbar-brand">Inventa</li>
        </ul>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{% if app.request.attributes.get('_route') starts with 'expenses' %}active{% endif %}"><a  href="{{ path('expenses') }} ">Expenses</a></li>
        <li class="{% if app.request.attributes.get('_route') starts with 'suppliers' %}active{% endif %}"><a href="{{ path('suppliers') }}">Fornecedores</a></li>
        <li class="{% if app.request.attributes.get('_route') starts with 'currencies' %}active{% endif %}"><a href="{{ path('currencies') }}">Moeda</a></li>
        <li><a href="#">Transações(*)</a></li>
        
      </ul>
     
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>*/            





















