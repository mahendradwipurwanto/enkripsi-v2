<?php
class TemplateFront
{
    protected $_ci;

    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->database();
    }

    public function getSettingsValue($key)
    {
        $query = $this->_ci->db->get_where('tb_settings', ['key' => $key]);
        return $query->row()->value;
    }

    public function getSettingsMetode($key)
    {
        $query = $this->_ci->db->get_where('tb_settings', ['key' => $key]);
        return $query->row();
    }

    public function view($content, $data = null)
    {
        $data['avatar'] = rand(1, 4);

        $data['web_title'] = $this->getSettingsValue('web_title');
        $data['web_desc'] = $this->getSettingsValue('web_desc');
        $data['web_icon'] = $this->getSettingsValue('web_icon');
        $data['web_logo'] = $this->getSettingsValue('web_logo');

        $data['shopeepay'] = $this->getSettingsMetode('metode_shopeepay');
        $data['dana'] = $this->getSettingsMetode('metode_dana');
        $data['bca'] = $this->getSettingsMetode('metode_bca');
        $data['bri'] = $this->getSettingsMetode('metode_bri');
        $data['mandiri'] = $this->getSettingsMetode('metode_mandiri');

        $this->_ci->load->view('template/frontend/header', $data);
        $this->_ci->load->view('template/alert', $data);
        $this->_ci->load->view('template/frontend/navbar', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('template/frontend/footer', $data);
    }
}
