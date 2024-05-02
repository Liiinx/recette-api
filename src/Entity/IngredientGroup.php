<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\IngredientGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: IngredientGroupRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Patch(),
        new Delete()
    ]
)]
class IngredientGroup
{
    use HasIdTrait;
    use HasNameTrait;

    #[ORM\Column]
    #[Groups(['get'])]
    private ?int $priority = null;

    #[ORM\OneToMany(mappedBy: 'ingredientGroup', targetEntity: RecipeHasIngredient::class)]
    private Collection $recipeHasIngredients;

    public function __construct()
    {
        $this->recipeHasIngredients = new ArrayCollection();
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection<int, RecipeHasIngredient>
     */
    public function getRecipeHasIngredients(): Collection
    {
        return $this->recipeHasIngredients;
    }

    public function addRecipeHasIngredient(RecipeHasIngredient $recipeHasIngredient): static
    {
        if (!$this->recipeHasIngredients->contains($recipeHasIngredient)) {
            $this->recipeHasIngredients->add($recipeHasIngredient);
            $recipeHasIngredient->setIngredientGroup($this);
        }

        return $this;
    }

    public function removeRecipeHasIngredient(RecipeHasIngredient $recipeHasIngredient): static
    {
        if ($this->recipeHasIngredients->removeElement($recipeHasIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeHasIngredient->getIngredientGroup() === $this) {
                $recipeHasIngredient->setIngredientGroup(null);
            }
        }

        return $this;
    }
}
