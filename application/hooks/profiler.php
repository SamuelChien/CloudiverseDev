<?php
// profiler.php
class MY_Profiler
{
    private $CI;
    
    public function enable()
    {
        $this->CI =& get_instance();
        if (!$this->CI->input->is_ajax_request())
        {
            if ($this->CI->config->item('profiler'))
            {
                $this->CI->output->enable_profiler(TRUE);
            }
        }
    }
}

/* End of file profiler.php */
/* Location: ../application/hooks/profiler.php */