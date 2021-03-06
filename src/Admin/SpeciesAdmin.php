<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Librinfo\VarietiesBundle\Admin;

use Sonata\CoreBundle\Validator\ErrorElement;
use Blast\CoreBundle\Admin\CoreAdmin;
use Librinfo\VarietiesBundle\Entity\Species;

class SpeciesAdmin extends CoreAdmin
{
    /**
     * @param ErrorElement $errorElement
     * @param mixed        $object
     *
     * @deprecated this feature cannot be stable, use a custom validator,
     *             the feature will be removed with Symfony 2.2
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $this->validateSpeciesCode($errorElement, $object);
    }

    /**
     * Species code validator.
     *
     * @param ErrorElement $errorElement
     * @param Species      $object
     */
    public function validateSpeciesCode(ErrorElement $errorElement, $object)
    {
        $generator = $this->getConfigurationPool()->getContainer()->get('librinfo_varieties.code_generator.species');
        if (!$generator->validate($object->getCode())) {
            $errorElement
                ->with('code')
                    ->addViolation('Wrong species code format')
                ->end();
        }
    }
}
