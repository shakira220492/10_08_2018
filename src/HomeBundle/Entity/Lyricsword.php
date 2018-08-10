<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lyricsword
 *
 * @ORM\Table(name="lyricsWord", indexes={@ORM\Index(name="lyricsLine_id", columns={"lyricsLine_id"})})
 * @ORM\Entity
 */
class Lyricsword
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lyricsWord_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $lyricswordId;

    /**
     * @var string
     *
     * @ORM\Column(name="lyricsWord_content", type="string", length=40, nullable=false)
     */
    private $lyricswordContent;

    /**
     * @var integer
     *
     * @ORM\Column(name="lyricsWord_startTime", type="integer", nullable=false)
     */
    private $lyricswordStarttime;

    /**
     * @var integer
     *
     * @ORM\Column(name="lyricsWord_endTime", type="integer", nullable=false)
     */
    private $lyricswordEndtime;

    /**
     * @var \Lyricsline
     *
     * @ORM\ManyToOne(targetEntity="Lyricsline")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lyricsLine_id", referencedColumnName="lyricsLine_id")
     * })
     */
    private $lyricsline;



    /**
     * Get lyricswordId
     *
     * @return integer
     */
    public function getLyricswordId()
    {
        return $this->lyricswordId;
    }

    /**
     * Set lyricswordContent
     *
     * @param string $lyricswordContent
     *
     * @return Lyricsword
     */
    public function setLyricswordContent($lyricswordContent)
    {
        $this->lyricswordContent = $lyricswordContent;

        return $this;
    }

    /**
     * Get lyricswordContent
     *
     * @return string
     */
    public function getLyricswordContent()
    {
        return $this->lyricswordContent;
    }

    /**
     * Set lyricswordStarttime
     *
     * @param integer $lyricswordStarttime
     *
     * @return Lyricsword
     */
    public function setLyricswordStarttime($lyricswordStarttime)
    {
        $this->lyricswordStarttime = $lyricswordStarttime;

        return $this;
    }

    /**
     * Get lyricswordStarttime
     *
     * @return integer
     */
    public function getLyricswordStarttime()
    {
        return $this->lyricswordStarttime;
    }

    /**
     * Set lyricswordEndtime
     *
     * @param integer $lyricswordEndtime
     *
     * @return Lyricsword
     */
    public function setLyricswordEndtime($lyricswordEndtime)
    {
        $this->lyricswordEndtime = $lyricswordEndtime;

        return $this;
    }

    /**
     * Get lyricswordEndtime
     *
     * @return integer
     */
    public function getLyricswordEndtime()
    {
        return $this->lyricswordEndtime;
    }

    /**
     * Set lyricsline
     *
     * @param \HomeBundle\Entity\Lyricsline $lyricsline
     *
     * @return Lyricsword
     */
    public function setLyricsline(\HomeBundle\Entity\Lyricsline $lyricsline = null)
    {
        $this->lyricsline = $lyricsline;

        return $this;
    }

    /**
     * Get lyricsline
     *
     * @return \HomeBundle\Entity\Lyricsline
     */
    public function getLyricsline()
    {
        return $this->lyricsline;
    }
}
