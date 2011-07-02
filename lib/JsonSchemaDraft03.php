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

class JsonSchemaDraft03 extends JsonSchemaDraft02
{
    var $ENVIRONMENT,
        $TYPE_VALIDATORS,
        $SCHEMA,
        $HYPERSCHEMA,
        $LINKS,
        $draft1,
        $draft2;

    function __construct($register = true)
    {
        $this->draft1 = new JsonSchemaDraft01For03();
        $this->draft2 = new JsonSchemaDraft02For03();
        $this->initializeTypeValidators();
        $this->initializeEnvironment();
        $this->initializeSchema();
        $this->initializeHyperSchema();
        $this->initializeLinks();
    
        if ($register) {
            $this->registerSchemas();
        }
    }

    function registerSchemas()
    {	

        ENVIRONMENT.setOption("defaultFragmentDelimiter", "/");
        ENVIRONMENT.setOption("defaultSchemaURI", "http://json-schema.org/draft-02/schema#");  //update later
        
        SCHEMA_02 = ENVIRONMENT.createSchema(SCHEMA_02_JSON, true, "http://json-schema.org/draft-02/schema#");
        HYPERSCHEMA_02 = ENVIRONMENT.createSchema(JSV.inherits(SCHEMA_02, ENVIRONMENT.createSchema(HYPERSCHEMA_02_JSON, true, "http://json-schema.org/draft-02/hyper-schema#"), true), true, "http://json-schema.org/draft-02/hyper-schema#");
        
        ENVIRONMENT.setOption("defaultSchemaURI", "http://json-schema.org/draft-02/hyper-schema#");
        
        LINKS_02 = ENVIRONMENT.createSchema(LINKS_02_JSON, HYPERSCHEMA_02, "http://json-schema.org/draft-02/links#");
        
        //We need to reinitialize these 3 schemas as they all reference each other
        SCHEMA_02 = ENVIRONMENT.createSchema(SCHEMA_02.getValue(), HYPERSCHEMA_02, "http://json-schema.org/draft-02/schema#");
        HYPERSCHEMA_02 = ENVIRONMENT.createSchema(HYPERSCHEMA_02.getValue(), HYPERSCHEMA_02, "http://json-schema.org/draft-02/hyper-schema#");
        LINKS_02 = ENVIRONMENT.createSchema(LINKS_02.getValue(), HYPERSCHEMA_02, "http://json-schema.org/draft-02/links#");
    }
}