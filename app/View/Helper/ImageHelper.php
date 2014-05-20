<?php  
class ImageHelper extends Helper { 
    var $helpers = array('Html'); 
     
    public $saveDir = 'cache';

   /**
   * Você pode especificar qualquer um dos seguintes modos de redimensionamento para seus tamanhos:
   *
   * 100x80   - redimensionar para melhor ajuste para estas dimensões, com bordas recortadas se sobrepõem a proporção original difere
   * [100x80] - redimensionar para caber essas dimensões, com o branco bandas se proporção original difere
   * 100w - manter a relação de aspecto original, redimensionar para 100 pixels de largura
   * 80h - manter a relação de aspecto original, redimensione a 80 pixels de altura
   * 80l - manter a relação de aspecto original, redimensione para que lado maior é de 80 pixels
   * 
   * passar os valores em forma de array
   * 
   * @param string  $srcFile nome da imagem
   * @param array   $htmlAttributes Array dos atributos do HTML 
   * @param string  $path   Caminho para o arquivo de imagem 
   * @param string  $tam    Tamanho para redimensionar ex: 940x350 
   * @param string  $prefix Acrescentar um prefixo no nome da imagem
   * @param string  $suffix Acrescentar um sufixo  no nome da imagem
   * @param string  $resize a forma que vai ser usado para redimensionar pelo php ou imagick
   * @return mixed  retorna a tag img com as tags dos atributos e o novo nome da imagem Html
   * @access public 
   * 
   * exemplo uso
   * $this->Image->image($var['Model']['nome_imgem'], array(atributos do Html),array(atributos da Imagem));
   * $this->Image->image($produto['Imagem']['nome'], 
   *        array('class'=>'imagem_produto','alt'=>$produto['Produto']['nome']),array('tam'=>'350w','suffix'=>'_large')); 
   *  
   */
    public function image($srcFile,$htmlAttributes = array(),$options = array()) {
        // verifica se tem o nome do arquivo
        if(isset($srcFile) && !empty($srcFile))
            $options['srcFile'] = $srcFile;
        else
            return;

        // verifica se so gera a imagem ou a imagem com a tag Html
        if(isset($options['return'])){ 
            $retorno = $options['return'];
        } else {
            $retorno = true;
        }

        $patch  = ROOT . DS . APP_DIR . DS . WEBROOT_DIR .DS . 'arquivos_sync' . DS;
        if (!file_exists($patch . $srcFile)) {

        	// $noImgOptions = array();
        	// if (preg_match('/^\\[[\\d]+x[\\d]+\\]$/', $options['tam'])) {
        	// 	list($destW, $destH) = explode('x', substr($options['tam'], 1, strlen($options['tam'])-2));
        	// 	$noImgOptions = array(
        	// 		'width'=>$destW, 
        	// 		'height'=>$destH
        	// 	);
        	// } elseif (preg_match('/^[\\d]+x[\\d]+$/', $options['tam'])) {
         //        list($destW, $destH) = explode('x', $options['tam']);
         //        $noImgOptions = array(
         //        	'width'=>$destW, 
         //        	'height'=>$destH
         //        );
         //    }
        	return $this->Html->image('/arquivos_sync/sem_foto.jpg', array('class'=>"img-produto"));
        }

        if (isset($options['resize']) && $options['resize'] == 'imagick')
            $srcFile = $this->_resizeImagick($options);
        else
            $srcFile = $this->_resizePhp($options);

        
       
        if($retorno) {
            $htmlAttributes = array_merge(array('width'=>$srcFile['size'][0],'height'=>$srcFile['size'][1]), $htmlAttributes);
            return $this->Html->image($srcFile['srcFile'],$htmlAttributes); 
        }
           
    }
   
    protected function _resizePhp($options = array()) {
        $options = $this->isCheck($options);
        if(!file_exists($options['destFile'])){
          
            copy($options['patchFile'], $options['destFile']);
            $src = null;
            $createHandler = null;
            $outputHandler = null;
            switch (strtolower($options['extension'])) {
                case 'gif':
                    $createHandler = 'imagecreatefromgif';
                    $outputHandler = 'imagegif';
                    break;
                case 'jpg':
                case 'jpeg':
                    $createHandler = 'imagecreatefromjpeg';
                    $outputHandler = 'imagejpeg';
                    break;
                case 'png':
                    $createHandler = 'imagecreatefrompng';
                    $outputHandler = 'imagepng';
                    break;
                default:
                    return false;
            }
            if ($src = $createHandler($options['destFile'])) {
                $srcW = imagesx($src);
                $srcH = imagesy($src);
                
                // determinar as dimensões de destino e o modo de redimensionamento da forma que forneceu $geometry
                if (preg_match('/^\\[[\\d]+x[\\d]+\\]$/', $options['geometry'])) {
                    // resize with banding [100x80]
                    list($destW, $destH) = explode('x', substr($options['geometry'], 1, strlen($options['geometry'])-2));
                    $resizeMode = 'band';
                } elseif (preg_match('/^[\\d]+x[\\d]+$/', $options['geometry'])) {
                    // cropped resize (best fit) 100x80
                    list($destW, $destH) = explode('x', $options['geometry']);
                    $resizeMode = 'best';
                } elseif (preg_match('/^[\\d]+w$/', $options['geometry'])) {
                    //  calcular largura com a relação de aspecto 100w
                    $destW = (int)$options['geometry']-1;
                    $resizeMode = false;
                } elseif (preg_match('/^[\\d]+h$/', $options['geometry'])) {
                    // calcular a largura de acordo com a relação de aspecto 80h
                    $destH = (int)$options['geometry']-1;
                    $resizeMode = false;
                } elseif (preg_match('/^[\\d]+l$/', $options['geometry'])) {
                    // calcular o lado mais curto de acordo com a relação de aspecto 80l
                    if ($srcW > $srcH) $destW = (int)$options['geometry']-1;
                    else $destH = (int)$options['geometry']-1;
                    $resizeMode = false;
                }
                
                if (!isset($destW)) $destW = ($destH/$srcH) * $srcW;
                if (!isset($destH)) $destH = ($destW/$srcW) * $srcH;

                // determine resize dimensions from appropriate resize mode and ratio
                if ($resizeMode == 'best') {
                    // "best fit" mode
                    if ($srcW > $srcH) {
                        if ($srcH/$destH > $srcW/$destW) $ratio = $destW/$srcW;
                        else $ratio = $destH/$srcH;
                    } else {
                        if ($srcH/$destH < $srcW/$destW) $ratio = $destH/$srcH;
                        else $ratio = $destW/$srcW;
                    }
                    $resizeW = $srcW*$ratio;
                    $resizeH = $srcH*$ratio;
                } else if ($resizeMode == 'band') {
                    // "banding" mode
                    if ($srcW > $srcH) $ratio = $destW/$srcW;
                    else $ratio = $destH/$srcH;
                    $resizeW = $srcW*$ratio;
                    $resizeH = $srcH*$ratio;
                } else {
                    // no resize ratio
                    $resizeW = $destW;
                    $resizeH = $destH;
                }
                $img = imagecreatetruecolor(ceil($destW), ceil($destH));
                imagefill($img, 0, 0, imagecolorallocate($img, 255, 255, 255));
                imagecopyresampled($img, $src, (ceil($destW)-ceil($resizeW))/2, (ceil($destH)-ceil($resizeH))/2, 0, 0, ceil($resizeW), ceil($resizeH), ceil($srcW), ceil($srcH));
                

                $outputHandler($img, $options['destFile']);

                $options['size'] = getimagesize($options['destFile']);
                $options['srcFile'] = '/' .$options['patchWeb']. '/'.$this->saveDir . '/' . $options['name'];
                return $options;
            }
            return ;
        }

        $options['size'] = getimagesize($options['destFile']);
        $options['srcFile'] = '/' .$options['patchWeb']. '/'.$this->saveDir . '/' . $options['name'];
        return $options;
    }

    protected function isCheck($options = array()){
      
        if(isset($options['tam']))
            $options['geometry'] = $options['tam'];

        // forma o caminho da imagem de onde salvar
        if(isset($options['patch']))
            $patch = $options['patch'];
        else
            $patch = 'arquivos_sync';
        $options['patchWeb'] = $patch;
        $patch  = ROOT . DS . APP_DIR . DS . WEBROOT_DIR .DS . $patch . DS;
        
        if(!file_exists($patch))
            mkdir($patch, 0777);
        $options['patch']     = $patch;
        $options['patchFile'] = $patch . $options['srcFile'];

        $savePatch = $patch . $this->saveDir . DS;
        if(!file_exists($savePatch))
            mkdir($savePatch, 0777);

        $pathInfo = $this->_pathinfo($options['srcFile']);
        $options['extension'] = $pathInfo['extension'];

        if (!empty($options['suffix']) AND empty($options['prefix'])) {
            $options['destFile'] = $savePatch . $pathInfo['filename'] . $options['suffix'] . '.' .$pathInfo['extension'];
            $options['name'] = $pathInfo['filename'] . $options['suffix'] . '.' .$pathInfo['extension'];
            unset($options['suffix']);
      
        } elseif (empty($options['suffix']) AND !empty($options['prefix'])) {
            $options['destFile'] = $savePatch . $options['prefix'] . $pathInfo['filename'] . '.' .$pathInfo['extension'];
            $options['name'] = $options['prefix'] . $pathInfo['filename'] . '.' .$pathInfo['extension'];
            unset($options['prefix']);
       
        } elseif (!empty($options['suffix']) AND !empty($options['prefix'])) {
            $options['destFile'] = $savePatch. $options['prefix']. $pathInfo['filename']. $options['suffix']. '.' .$pathInfo['extension'];
            $options['name'] = $options['prefix']. $pathInfo['filename']. $options['suffix']. '.' .$pathInfo['extension'];
            unset($options['prefix']);
            unset($options['suffix']);
        } else{
            $options['destFile'] = $savePatch. $pathInfo['filename'] .'.'. $pathInfo['extension'];
            $options['name'] = $pathInfo['filename'] .'.'. $pathInfo['extension'];
        }
        return $options;
    }

    protected function _pathinfo($filename) {
        $pathInfo = pathinfo($filename);

        if (!isset($pathInfo['extension']) || !strlen($pathInfo['extension'])) {
            $pathInfo['extension'] = '';
        }
        // PHP < 5.2.0 não inclui chave 'filename' em pathinfo. Vamos tentar corrigir isso.
        if (empty($pathInfo['filename'])) {
            $pathInfo['filename'] = basename($pathInfo['basename'], '.' . $pathInfo['extension']);
        }
        return $pathInfo;
    }
} 
?>