<?php

namespace chev\PensionBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SupplementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SupplementRepository extends EntityRepository
{
	/**
     * Trouver les suppléments par le gérant
     * 
     * @param User $gerant Le gérant
     * 
     * @return Entity
     */
	public function findByGerant($gerant) {
		return $this->_em
                ->createQuery('SELECT s FROM chevPensionBundle:Supplement s
                               JOIN s.facture f
                               JOIN f.box b
                               JOIN b.type t
                               JOIN t.centre c
                               WHERE c.gerant = :gerant')
                ->setParameter(':gerant', $gerant)
                ->getResult();
	}
	/**
     * Trouver un supplement par l'id et le gérant
     * 
     * @param User $gerant Le gérant
     * @param int $id l'id
     * 
     * @return Entity
     */
	public function findOneByGerant($gerant, $id) {
		return $this->_em
                ->createQuery('SELECT s FROM chevPensionBundle:Supplement s
                               JOIN s.facture f
                               JOIN f.box b
                               JOIN b.type t
                               JOIN t.centre c
                               WHERE c.gerant = :gerant
                               AND s.id = :id')
                ->setParameter(':gerant', $gerant)
				->setParameter(':id', $id)
                ->getOneOrNullResult();
	}
}