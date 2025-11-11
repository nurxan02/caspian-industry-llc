-- Sample data for Caspian Industry

-- Site Settings
INSERT INTO site_settings (setting_key, setting_value) VALUES 
('company_name', 'Caspian Industry LLC'),
('address', 'Baku, Azerbaijan'),
('phone', '+994 12 123 45 67'),
('email', 'info@caspianindustry.com'),
('facebook', 'https://facebook.com/caspianindustry'),
('linkedin', 'https://linkedin.com/company/caspianindustry'),
('instagram', 'https://instagram.com/caspianindustry');

-- Sample News
INSERT INTO news (title_en, title_ru, title_az, content_en, content_ru, content_az, excerpt_en, excerpt_ru, excerpt_az, published_date, is_published) VALUES
('New Oil & Gas Project Launch', 'Запуск нового нефтегазового проекта', 'Yeni Neft və Qaz Layihəsinin Başlanması', 
'We are excited to announce the launch of our new oil and gas infrastructure project in the Caspian region. This project will enhance energy security and create new opportunities for regional development.', 
'Мы рады объявить о запуске нашего нового проекта нефтегазовой инфраструктуры в Каспийском регионе. Этот проект повысит энергетическую безопасность и создаст новые возможности для регионального развития.',
'Xəzər regionunda yeni neft-qaz infrastrukturu layihəmizin başlanmasını elan etməkdən məmnunuq. Bu layihə enerji təhlükəsizliyini artıracaq və regional inkişaf üçün yeni imkanlar yaradacaq.',
'New infrastructure project in the Caspian region', 'Новый инфраструктурный проект в Каспийском регионе', 'Xəzər regionunda yeni infrastruktur layihəsi',
'2024-11-01', 1),

('Partnership with Leading Energy Company', 'Партнерство с ведущей энергетической компанией', 'Aparıcı Enerji Şirkəti ilə Tərəfdaşlıq',
'Caspian Industry has signed a strategic partnership agreement with a leading international energy company. This collaboration will bring cutting-edge technology and expertise to our operations.',
'Caspian Industry подписала соглашение о стратегическом партнерстве с ведущей международной энергетической компанией. Это сотрудничество принесет передовые технологии и опыт в наши операции.',
'Caspian Industry aparıcı beynəlxalq enerji şirkəti ilə strateji tərəfdaşlıq müqaviləsi imzaladı. Bu əməkdaşlıq əməliyyatlarımıza ən müasir texnologiya və təcrübə gətirəcək.',
'Strategic partnership brings new opportunities', 'Стратегическое партнерство открывает новые возможности', 'Strateji tərəfdaşlıq yeni imkanlar açır',
'2024-10-15', 1),

('Industry Safety Award 2024', 'Награда за безопасность в отрасли 2024', '2024 Sənaye Təhlükəsizliyi Mükafatı',
'We are proud to receive the Industry Safety Excellence Award 2024. This recognition reflects our commitment to maintaining the highest safety standards in all our operations.',
'Мы гордимся получением награды за выдающиеся достижения в области безопасности в отрасли 2024 года. Это признание отражает нашу приверженность поддержанию высочайших стандартов безопасности во всех наших операциях.',
'2024-cü il üçün Sənaye Təhlükəsizliyi Mükəmməllik Mükafatını almaqdan qürur duyuruq. Bu tanınma bütün əməliyyatlarımızda ən yüksək təhlükəsizlik standartlarının saxlanması öhdəliyimizi əks etdirir.',
'Recognition for excellence in safety standards', 'Признание за превосходные стандарты безопасности', 'Təhlükəsizlik standartlarında mükəmməlliyə görə tanınma',
'2024-09-20', 1);

-- Sample Projects
INSERT INTO projects (title_en, title_ru, title_az, description_en, description_ru, description_az, client, location, completion_date, sort_order, is_published) VALUES
('Offshore Platform Construction', 'Строительство морской платформы', 'Açıq Dəniz Platformasının Tikintisi',
'Complete construction and installation of offshore oil platform with state-of-the-art technology. The project includes drilling equipment, processing facilities, and accommodation modules for 200 personnel.',
'Полное строительство и установка морской нефтяной платформы с использованием новейших технологий. Проект включает буровое оборудование, перерабатывающие мощности и жилые модули на 200 человек.',
'Ən müasir texnologiya ilə açıq dəniz neft platformasının tam tikintisi və quraşdırılması. Layihə 200 işçi üçün qazma avadanlığı, emal obyektləri və yaşayış modullarını əhatə edir.',
'National Oil Company', 'Caspian Sea', '2024-08-15', 1, 1),

('Pipeline Infrastructure Development', 'Развитие трубопроводной инфраструктуры', 'Boru Kəməri İnfrastrukturunun İnkişafı',
'Design and construction of 150km pipeline system connecting major production facilities. Features advanced monitoring systems and environmental protection measures.',
'Проектирование и строительство 150-км системы трубопроводов, соединяющей основные производственные объекты. Включает передовые системы мониторинга и меры защиты окружающей среды.',
'Əsas istehsal obyektlərini birləşdirən 150 km boru kəməri sisteminin layihələndirilməsi və tikintisi. Qabaqcıl monitorinq sistemləri və ətraf mühitin qorunması tədbirləri var.',
'Trans-Caspian Energy', 'Azerbaijan-Georgia', '2024-12-30', 2, 1),

('Refinery Modernization', 'Модернизация нефтеперерабатывающего завода', 'Neft Emalı Zavodunun Modernləşdirilməsi',
'Comprehensive upgrade of existing refinery facilities to meet European environmental standards. Includes new processing units and waste management systems.',
'Комплексная модернизация существующих нефтеперерабатывающих мощностей для соответствия европейским экологическим стандартам. Включает новые перерабатывающие установки и системы управления отходами.',
'Avropa ekoloji standartlarına cavab vermək üçün mövcud neft emalı müəssisələrinin hərtərəfli təkmilləşdirilməsi. Yeni emal qurğuları və tullantıların idarə edilməsi sistemləri daxildir.',
'Baku Oil Refinery', 'Baku, Azerbaijan', '2025-03-20', 3, 1);

-- Sample Partners
INSERT INTO partners (name, logo, website, sort_order) VALUES
('BP', 'bp-logo.png', 'https://www.bp.com', 1),
('Shell', 'shell-logo.png', 'https://www.shell.com', 2),
('TotalEnergies', 'total-logo.png', 'https://www.totalenergies.com', 3),
('Chevron', 'chevron-logo.png', 'https://www.chevron.com', 4),
('SOCAR', 'socar-logo.png', 'https://www.socar.az', 5),
('Equinor', 'equinor-logo.png', 'https://www.equinor.com', 6),
('Lukoil', 'lukoil-logo.png', 'https://www.lukoil.com', 7),
('Petrofac', 'petrofac-logo.png', 'https://www.petrofac.com', 8);

-- Sample FAQ
INSERT INTO faq (question_en, question_ru, question_az, answer_en, answer_ru, answer_az, sort_order) VALUES
('What services does Caspian Industry provide?', 'Какие услуги предоставляет Caspian Industry?', 'Caspian Industry hansı xidmətlər göstərir?',
'We provide comprehensive solutions for oil & gas industry including offshore platform construction, pipeline infrastructure, refinery services, and industrial equipment supply.',
'Мы предоставляем комплексные решения для нефтегазовой отрасли, включая строительство морских платформ, инфраструктуру трубопроводов, услуги НПЗ и поставку промышленного оборудования.',
'Biz neft və qaz sənayesi üçün açıq dəniz platformalarının tikintisi, boru kəməri infrastrukturu, neft emalı xidmətləri və sənaye avadanlığı təchizatı daxil olmaqla hərtərəfli həllər təqdim edirik.',
1),

('Where are your main operations located?', 'Где расположены ваши основные операции?', 'Əsas əməliyyatlarınız harada yerləşir?',
'Our headquarters is in Baku, Azerbaijan, with project operations across the Caspian region including Azerbaijan, Kazakhstan, and Turkmenistan.',
'Наша штаб-квартира находится в Баку, Азербайджан, с проектными операциями по всему Каспийскому региону, включая Азербайджан, Казахстан и Туркменистан.',
'Baş ofisimiz Bakı, Azərbaycandadır, layihə əməliyyatları Azərbaycan, Qazaxıstan və Türkmənistan daxil olmaqla Xəzər regionunda həyata keçirilir.',
2),

('How can I request a quote?', 'Как я могу запросить расценки?', 'Təklif necə istəyə bilərəm?',
'You can request a quote by contacting us through our contact form, email, or phone. Our team will respond within 24 hours with detailed information.',
'Вы можете запросить расценки, связавшись с нами через контактную форму, электронную почту или телефон. Наша команда ответит в течение 24 часов с подробной информацией.',
'Bizimlə əlaqə forması, e-poçt və ya telefon vasitəsilə əlaqə saxlayaraq təklif istəyə bilərsiniz. Komandamız 24 saat ərzində ətraflı məlumatla cavab verəcək.',
3),

('Do you offer maintenance services?', 'Предлагаете ли вы услуги по техническому обслуживанию?', 'Texniki xidmət göstərirsinizmi?',
'Yes, we provide comprehensive maintenance and support services for all equipment and installations we supply. Our service includes regular inspections, preventive maintenance, and emergency repairs.',
'Да, мы предоставляем комплексные услуги по техническому обслуживанию и поддержке для всего оборудования и установок, которые мы поставляем. Наш сервис включает регулярные проверки, профилактическое обслуживание и аварийный ремонт.',
'Bəli, biz tədarük etdiyimiz bütün avadanlıq və qurğular üçün hərtərəfli texniki xidmət və dəstək xidmətləri göstəririk. Xidmətimizə müntəzəm yoxlamalar, profilaktik texniki xidmət və təcili təmirlər daxildir.',
4);

-- Sample Gallery Items
INSERT INTO gallery (title_en, title_ru, title_az, image, description_en, description_ru, description_az, sort_order) VALUES
('Offshore Platform', 'Морская платформа', 'Açıq Dəniz Platforması', 'gallery-1.jpg', 'Oil platform construction', 'Строительство нефтяной платформы', 'Neft platformasının tikintisi', 1),
('Pipeline Construction', 'Строительство трубопровода', 'Boru Kəməri Tikintisi', 'gallery-2.jpg', 'Pipeline infrastructure project', 'Проект инфраструктуры трубопровода', 'Boru kəməri infrastruktur layihəsi', 2),
('Refinery Facility', 'Нефтеперерабатывающий завод', 'Neft Emalı Zavodu', 'gallery-3.jpg', 'Modern refinery plant', 'Современный нефтеперерабатывающий завод', 'Müasir neft emalı zavodu', 3),
('Team at Work', 'Команда за работой', 'İşdə Komanda', 'gallery-4.jpg', 'Our professional team', 'Наша профессиональная команда', 'Peşəkar komandamız', 4),
('Industrial Equipment', 'Промышленное оборудование', 'Sənaye Avadanlığı', 'gallery-5.jpg', 'High-tech industrial equipment', 'Высокотехнологичное промышленное оборудование', 'Yüksək texnoloji sənaye avadanlığı', 5),
('Quality Control', 'Контроль качества', 'Keyfiyyətə Nəzarət', 'gallery-6.jpg', 'Quality assurance process', 'Процесс обеспечения качества', 'Keyfiyyət təminatı prosesi', 6);
