<?php

namespace Content\Support\Traits;

use Course\Models\Scormvar;
use Course\Models\Status;
use Illuminate\Support\Facades\File;
use SimpleXMLElement;

trait ContentMutator
{
    /**
     * Route show shortcut.
     *
     * @return \Illuminate\Routing\Route
     */
    public function getUrlAttribute()
    {
        return route('contents.show', [$this->lesson->course->slug, $this->lesson->id, $this->id]);
    }

    /**
     * Gets the next content via sort order.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNextAttribute()
    {
        $sort = $this->sort;
        $contents = $this->course->contents()->orderBy('sort', 'ASC')->get();

        $next = null;
        foreach ($contents as $i => $content) {
            if ($content->sort == $sort) {
                if (isset($contents[$i+1])) {
                    return $contents[$i+1];
                }
            }
        }

        return false;
    }

    /**
     * Gets the next content via sort order.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getPreviousAttribute()
    {
        $sort = $this->sort;
        $contents = $this->course->contents()->orderBy('sort', 'ASC')->get();

        $next = null;
        foreach ($contents as $i => $content) {
            if ($content->sort == $sort) {
                if (isset($contents[$i-1])) {
                    return $contents[$i-1];
                }
            }
        }

        return false;
    }

    /**
     * Gets the current order of the resource.
     *
     * @return integer
     */
    public function getOrderAttribute()
    {
        return (int) $this->sort+1;
    }

    /**
     * Gets the Interactive file.
     *
     * @return mixed
     */
    public function getInteractiveAttribute()
    {
        $entrypoint = "";
        try {
            if ($this->library) {
                switch ($this->library->mimetype) {
                    case 'application/zip':
                    case 'application/rar':
                    case 'application/x-zip-compressed':
                    case 'application/x-rar-compressed':
                    case 'application/*':
                        $date = date('Y-m-d', strtotime($this->library->created_at));
                        $path = settings('package.storage_path', 'public/package') . "/$date/{$this->library->id}";

                        if (file_exists(storage_path("$path/imsmanifest.xml"))) {
                            $xml = $this->imsmanifest;
                            $entrypoint = isset($xml->resources->resource['href'])
                                            ? utf8_decode(urldecode($xml->resources->resource['href']))
                                            : 'index.html';

                            $entrypoint = url("storage/$path/$entrypoint");
                        } elseif (file_exists(storage_path("$path/multiscreen.html"))) {
                            $entrypoint = url("storage/$path/multiscreen.html");
                        } else {
                            $entrypoint = url("storage/$path/index.html");
                        }
                        break;

                    case 'video/ogg':
                    case 'video/mp4':
                    case 'video/wmv':
                    default:
                        $entrypoint = url("storage/{$this->library->url}");
                        break;
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $entrypoint;
    }

    /**
     * Try to get the imsmanifest.xml file as a
     * SimpleXMLElement.
     *
     * @return mixed
     */
    public function getImsmanifestAttribute()
    {
        $imsmanifest = false;

        try {
            if ($this->library) {
                $date = date('Y-m-d', strtotime($this->library->created_at));
                $path = settings('package.storage_path', 'public/package') . "/$date/{$this->library->id}";

                if (file_exists(storage_path("$path/imsmanifest.xml"))) {
                    $xml = File::get(storage_path("$path/imsmanifest.xml"));
                    $imsmanifest = new SimpleXMLElement($xml);
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $imsmanifest;
    }

    /**
     * Returns the interactive content with
     * appropriate HTML tags.
     *
     * @return string
     */
    public function getHtmlAttribute()
    {
        $html = "";
        switch ($this->library->mimetype) {
            case 'application/zip':
            case 'application/rar':
            case 'application/x-zip-compressed':
            case 'application/x-rar-compressed':
            case 'application/*':
                $html = "<object data={$this->interactive} class='interactive-content' onunload=window.API.LMSFinish('') onbeforeunload=window.API.LMSFinish('')>
                            <param name='src' value={$this->interactive}>
                            <param name='autoplay' value=false>
                            <param name='autoStart' value=0>
                            <embed src={$this->interactive}>
                        </object>";
                break;

            case 'video/ogg':
            case 'video/mp4':
            case 'video/wmv':
                $html = "<video class='interactive-content' autobuffer autoplay controls width='100%' onunload=window.API.LMSFinish('') onbeforeunload=window.API.LMSFinish('')>
                            <source src='{$this->interactive}'>
                            <source src='{$this->interactive}'>
                            <object type='{$this->library->mimetype}' data='{$this->interactive}'>
                                <param name='src' value='{$this->interactive}'>
                                <param name='autoplay' value='false'>
                                <param name='autoStart' value='0'>
                            </object>
                        </video>";
                break;

            default:
                $html = "<object class='interactive-content' data={$this->interactive} width=100% height=auto onunload=window.API.LMSFinish('') onbeforeunload=window.API.LMSFinish('')>
                            <param name='src' value={$this->interactive}>
                            <param name='autoplay' value=false>
                            <param name='autoStart' value=0>
                            <embed type='{$this->library->mimetype}' src={$this->interactive}>
                        </object>";
                break;
        }

        return $html;
    }

    /**
     * Get the SCORM version.
     *
     * @return string
     */
    public function getVersionAttribute()
    {
        if ($this->imsmanifest) {
            if ($this->imsmanifest->metadata->schemaversion) {
                return $this->imsmanifest->metadata->schemaversion;
            } elseif ($this->imsmanifest->attributes()->version) {
                return $this->imsmanifest->attributes()->version;
            }

            return "";
        }

        return null;
    }
}
