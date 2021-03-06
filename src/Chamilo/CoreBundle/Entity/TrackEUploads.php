<?php

namespace Chamilo\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrackEUploads
 *
 * @ORM\Table(name="track_e_uploads", indexes={@ORM\Index(name="upload_user_id", columns={"upload_user_id"}), @ORM\Index(name="upload_cours_id", columns={"upload_cours_id"}), @ORM\Index(name="upload_session_id", columns={"upload_session_id"})})
 * @ORM\Entity
 */
class TrackEUploads
{
    /**
     * @var integer
     *
     * @ORM\Column(name="upload_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $uploadId;

    /**
     * @var integer
     *
     * @ORM\Column(name="upload_user_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $uploadUserId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="upload_date", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $uploadDate;

    /**
     * @var string
     *
     * @ORM\Column(name="upload_cours_id", type="string", length=40, precision=0, scale=0, nullable=false, unique=false)
     */
    private $uploadCoursId;

    /**
     * @var integer
     *
     * @ORM\Column(name="upload_work_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $uploadWorkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="upload_session_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $uploadSessionId;


    /**
     * Get uploadId
     *
     * @return integer
     */
    public function getUploadId()
    {
        return $this->uploadId;
    }

    /**
     * Set uploadUserId
     *
     * @param integer $uploadUserId
     * @return TrackEUploads
     */
    public function setUploadUserId($uploadUserId)
    {
        $this->uploadUserId = $uploadUserId;

        return $this;
    }

    /**
     * Get uploadUserId
     *
     * @return integer
     */
    public function getUploadUserId()
    {
        return $this->uploadUserId;
    }

    /**
     * Set uploadDate
     *
     * @param \DateTime $uploadDate
     * @return TrackEUploads
     */
    public function setUploadDate($uploadDate)
    {
        $this->uploadDate = $uploadDate;

        return $this;
    }

    /**
     * Get uploadDate
     *
     * @return \DateTime
     */
    public function getUploadDate()
    {
        return $this->uploadDate;
    }

    /**
     * Set uploadCoursId
     *
     * @param string $uploadCoursId
     * @return TrackEUploads
     */
    public function setUploadCoursId($uploadCoursId)
    {
        $this->uploadCoursId = $uploadCoursId;

        return $this;
    }

    /**
     * Get uploadCoursId
     *
     * @return string
     */
    public function getUploadCoursId()
    {
        return $this->uploadCoursId;
    }

    /**
     * Set uploadWorkId
     *
     * @param integer $uploadWorkId
     * @return TrackEUploads
     */
    public function setUploadWorkId($uploadWorkId)
    {
        $this->uploadWorkId = $uploadWorkId;

        return $this;
    }

    /**
     * Get uploadWorkId
     *
     * @return integer
     */
    public function getUploadWorkId()
    {
        return $this->uploadWorkId;
    }

    /**
     * Set uploadSessionId
     *
     * @param integer $uploadSessionId
     * @return TrackEUploads
     */
    public function setUploadSessionId($uploadSessionId)
    {
        $this->uploadSessionId = $uploadSessionId;

        return $this;
    }

    /**
     * Get uploadSessionId
     *
     * @return integer
     */
    public function getUploadSessionId()
    {
        return $this->uploadSessionId;
    }
}
