<?php
/**
 * json-schema-draft-01 Environment
 * 
 * @fileOverview Implementation of the first revision of the JSON Schema specification draft.
 * @author Gary Court <gary.court@gmail.com>
 * @author Gregory Beaver <greg@chiaraquartet.net>
 * @version 1.5
 * @see http://github.com/garycourt/JSV
 */
namespace JsonSchema;

/*
 * Copyright 2010 Gary Court. All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 * 
 *    1. Redistributions of source code must retain the above copyright notice, this list of
 *       conditions and the following disclaimer.
 * 
 *    2. Redistributions in binary form must reproduce the above copyright notice, this list
 *       of conditions and the following disclaimer in the documentation and/or other materials
 *       provided with the distribution.
 * 
 * THIS SOFTWARE IS PROVIDED BY GARY COURT ``AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL GARY COURT OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * The views and conclusions contained in the software and documentation are those of the
 * authors and should not be interpreted as representing official policies, either expressed
 * or implied, of Gary Court or the JSON Schema specification.
 */

/*jslint white: true, sub: true, onevar: true, undef: true, eqeqeq: true, newcap: true, immed: true, indent: 4 */
/*global require */

class JsonSchemaDraft01For03 extends JsonSchemaDraft01
{
    var $SCHEMA_00, $HYPERSCHEMA_00, $LINKS_00;
    function __construct()
    {
        $this->registerSchemas();
    }

    function registerSchemas()
    {
        $this->ENVIRONMENT->setOption("defaultFragmentDelimiter", ".");
        $this->ENVIRONMENT->setOption("defaultSchemaURI", "http://json-schema.org/draft-00/schema#");  //updated later
        
        $this->SCHEMA_00 = $this->ENVIRONMENT->createSchema($this->getSchemaArray(), true, "http://json-schema.org/draft-00/schema#");
        $this->HYPERSCHEMA_00 = $this->ENVIRONMENT->createSchema(JSV::inherits($this->SCHEMA_00,
                                                                               $this->ENVIRONMENT
                                                                               ->createSchema($this->getHyperSchemaArray(), true,
                                                                                              "http://json-schema.org/draft-00/hyper-schema#"),
                                                                               true), true, "http://json-schema.org/draft-00/hyper-schema#");
        
        $this->ENVIRONMENT->setOption("defaultSchemaURI", "http://json-schema.org/draft-00/hyper-schema#");
        
        $this->LINKS_00 = $this->ENVIRONMENT->createSchema($this->getLinksArray(), $this->HYPERSCHEMA_00, "http://json-schema.org/draft-00/links#");
        
        //We need to reinitialize these 3 schemas as they all reference each other
        $this->SCHEMA_00 = $this->ENVIRONMENT->createSchema($this->SCHEMA_00->getValue(), $this->HYPERSCHEMA_00, "http://json-schema.org/draft-00/schema#");
        $this->HYPERSCHEMA_00 = $this->ENVIRONMENT->createSchema($this->HYPERSCHEMA_00->getValue(), $this->HYPERSCHEMA_00, "http://json-schema.org/draft-00/hyper-schema#");
        $this->LINKS_00 = $this->ENVIRONMENT->createSchema($this->LINKS_00->getValue(), $this->HYPERSCHEMA_00, "http://json-schema.org/draft-00/links#");
        
        //
        // draft-01
        //
            
        SCHEMA_01_JSON = JSV.inherits(SCHEMA_00_JSON, {
            "$schema" : "http://json-schema.org/draft-01/hyper-schema#",
            "id" : "http://json-schema.org/draft-01/schema#"
        });
        
        HYPERSCHEMA_01_JSON = JSV.inherits(HYPERSCHEMA_00_JSON, {
            "$schema" : "http://json-schema.org/draft-01/hyper-schema#",
            "id" : "http://json-schema.org/draft-01/hyper-schema#"
        });
        
        LINKS_01_JSON = JSV.inherits(LINKS_00_JSON, {
            "$schema" : "http://json-schema.org/draft-01/hyper-schema#",
            "id" : "http://json-schema.org/draft-01/links#"
        });
        
        ENVIRONMENT.setOption("defaultSchemaURI", "http://json-schema.org/draft-01/schema#");  //update later
        
        SCHEMA_01 = ENVIRONMENT.createSchema(SCHEMA_01_JSON, true, "http://json-schema.org/draft-01/schema#");
        HYPERSCHEMA_01 = ENVIRONMENT.createSchema(JSV.inherits(SCHEMA_01, ENVIRONMENT.createSchema(HYPERSCHEMA_01_JSON, true, "http://json-schema.org/draft-01/hyper-schema#"), true), true, "http://json-schema.org/draft-01/hyper-schema#");
        
        ENVIRONMENT.setOption("defaultSchemaURI", "http://json-schema.org/draft-01/hyper-schema#");
        
        LINKS_01 = ENVIRONMENT.createSchema(LINKS_01_JSON, HYPERSCHEMA_01, "http://json-schema.org/draft-01/links#");
        
        //We need to reinitialize these 3 schemas as they all reference each other
        SCHEMA_01 = ENVIRONMENT.createSchema(SCHEMA_01.getValue(), HYPERSCHEMA_01, "http://json-schema.org/draft-01/schema#");
        HYPERSCHEMA_01 = ENVIRONMENT.createSchema(HYPERSCHEMA_01.getValue(), HYPERSCHEMA_01, "http://json-schema.org/draft-01/hyper-schema#");
        LINKS_01 = ENVIRONMENT.createSchema(LINKS_01.getValue(), HYPERSCHEMA_01, "http://json-schema.org/draft-01/links#");
    }

    function getSchemaArray()
    {
        $schema = parent::getSchemaArray();
        $schema['$schema'] = "http://json-schema.org/draft-00/hyper-schema#";
        $schema['id'] = "http://json-schema.org/draft-00/schema#";
        return $schema;
    }

    function getHyperSchemaArray()
    {
        $schema = parent::getHyperSchemaArray();
        $schema['$schema'] = "http://json-schema.org/draft-00/hyper-schema#";
        $schema['id'] = "http://json-schema.org/draft-00/hyper-schema#";
    }

    function getLinksArray()
    {
        $schema = parent::getLinksArray();
        $schema['$schema'] = "http://json-schema.org/draft-00/hyper-schema#";
        $schema['id'] = "http://json-schema.org/draft-00/links#";
        return $schema;
    }
}