--
-- Add new tab
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES
('basket-contact', 'basket-single', 'Contact', 'Shipping & Billing', 'fas fa-user', '', '1', '', ''),
('contact-basket', 'contact-single', 'Baskets', 'Shopping Baskets', 'fas fa-shopping-basket', '', '1', '', '');

--
-- Add new partial
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'partial', 'Contact', 'basket_contact', 'basket-contact', 'basket-single', 'col-md-12', '', '', '0', '1', '0', '', '', ''),
(NULL, 'hidden', 'Contact', 'contact_idfs', 'basket-base', 'basket-single', 'col-md-3', '', '', '0', '1', '0', '', '', ''),
(NULL, 'partial', 'Basket', 'contact_basket', 'contact-basket', 'contact-single', 'col-md-12', '', '', '0', '1', '0', '', '', '');


ALTER TABLE `basket` ADD `contact_idfs` int(11) NOT NULL DEFAULT 0 AFTER `label`;
