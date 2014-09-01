<?php

class SearchResultView
{
    public static function render($key,$data){

            if($key=='cities')
            {
                $label='Города';
                $img='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAPCAYAAADtc08vAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFISURBVHjahJKxZ0NRFMZvXiKEELqWRuiUqYQMFVqZyu0SMr0/oCXyB7R7aMnSoRrt1KWdSpdXSgkhOkS3UDImlE6VEkKV5jt8l+P2PTn8OO/cc4/zffelrLXGizsQmv9xCJ6YV8FIksDExz14Bl/gBrx75w2XJA04BZfgAxyDgTrbAwfcwmQSBkx5+RP8grRavwx2wLbIkAFH6qJeVTY4B3NQYE0unjDvSL9IuFCrhZ7Oa5BTtTzYYl6SbxnwQ6OGnuNiZB3sggfWI09qFHC9P3Bl1scYpEDPFcSDBdgHTaU14jv3wSvIgluwQc/K655R4pFPuFS1TfpSouxZQGPelLsu2qznE6TI8LEM+KaulmoosiFLmT1vgKVvNmCT6KqphpB/m6851sQcdRl1cKaGubNunIkZmuFiyIGLGN0z8AIqYEKWKwEGAEOQQvVIOyOJAAAAAElFTkSuQmCC';
                $prop='cityName';
            }
            else if($key=='regions'){
                $label='Регионы';
                $img='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAYAAAA7bUf6AAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAGQSURBVHjafJRPRERBHMd3Z1lis1oi0hJ5ERGlTrWnx+NR6hIdlkTUNVFKXUp0e6dY3dLaWB06xZI6rVaxRNdOEcsSERF9f3wfv8bs/viYnZ2Z7/z+vUmGYZiwbABsAB9MgxRogTq4Ir/6QNIS2QYHIJPobK9gFTTiP4xaPAenIA3OwJRcQnrBAg+OgXsQ2iJ7YI1uz4JN8Kwu+AI3YAYcgh5QASOymPI8bxDjNeP0tZsOy4Fb0AfmwJDkSDxZZwilLgKT4JL5EtsHH2BRvDEqtpLjcMj4n8AyiFR4Vf4ORCQPfsCLJRCw1AXO5dCbWq9zHBWRLJVtm2dFdjmPrPX4TNowtpzVG9JkD8yVeHmhbo5tmGPLqDB8tUESJlU7Aneg6PA03t8QkbLqFbF+jtLeW6DpEJhgztqgZri5yTKesOEkD+9deqXCb+oYfBs2WZGJ2mH7ZzsIjINHqQjDjOwPsMDOzdHNqmr9DHMQcC4CS+DT9RXnGdJKB0/aDCHSz0HS8Z4kWBnXe1Jjyf/ZnwADAGjsWWtRknTAAAAAAElFTkSuQmCC';
                $prop='regionName';

            }
            else if($key=='hotels') {
                $label='Отели';
                $img='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAEzSURBVHjaYvH29v7PQAFggdKMZOr/z8RAIaDYABZkzpw5czLFxcWPffz48eKDBw8Yjhw5wrBgwQIGDg4Ohl+/fjGwsrIy8PPzMzAxMWF3QV5eXvXDhw89z549y8DCwkK6F86dO/fv3bt3IDFtIJbFot4R5FCcBggICLAeP348JScn58Lq1atX8PDwyMEVAp1969Ytrl27dtnhDIMXL16wAp0vYWRkxHD//n3Ta9euzePm5r739+9fdkZGxn/CwsK6P3/+5MFpwOvXr/+vW7eOgZ2d/R8QsACxMzMzszM4oTAyMgD5IPwWpwFCQkJf7ezsaj58+LALGPJM//8jEinQgN83b94Munv3bh5OAyIjIx8aGhpeXrJkyX1sIS4nJ3teUlLyIrIYIzQvDIOkTHaWBggwALjfdA3njsxpAAAAAElFTkSuQmCC';
                $prop='hotelCity';
            }
            Yii::app()->getController()->renderPartial('oneResult',array('label'=>$label,'img'=>$img,'prop'=>$prop,'data'=>$data));

    }

}