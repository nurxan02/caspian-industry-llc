-- Sample News
INSERT INTO news (title_en, title_ru, title_az, content_en, content_ru, content_az, excerpt_en, excerpt_ru, excerpt_az, published_date, is_published) VALUES
('New Oil & Gas Project Launch', 'Запуск нового нефтегазового проекта', 'Yeni Neft və Qaz Layihəsinin Başlanması', 
'We are excited to announce the launch of our new oil and gas infrastructure project in the Caspian region. This project will enhance energy security and create new opportunities for regional development. The project includes state-of-the-art facilities, advanced technology, and comprehensive safety measures to ensure the highest standards of operation.', 
'Мы рады объявить о запуске нашего нового проекта нефтегазовой инфраструктуры в Каспийском регионе. Этот проект повысит энергетическую безопасность и создаст новые возможности для регионального развития. Проект включает в себя современные объекты, передовые технологии и комплексные меры безопасности для обеспечения высочайших стандартов эксплуатации.',
'Xəzər regionunda yeni neft-qaz infrastrukturu layihəmizin başlanmasını elan etməkdən məmnunuq. Bu layihə enerji təhlükəsizliyini artıracaq və regional inkişaf üçün yeni imkanlar yaradacaq. Layihə ən yüksək əməliyyat standartlarını təmin etmək üçün ən müasir obyektləri, qabaqcıl texnologiyaları və hərtərəfli təhlükəsizlik tədbirlərini əhatə edir.',
'New infrastructure project in the Caspian region', 'Новый инфраструктурный проект в Каспийском регионе', 'Xəzər regionunda yeni infrastruktur layihəsi',
'2024-11-01', 1),

('Partnership with Leading Energy Company', 'Партнерство с ведущей энергетической компанией', 'Aparıcı Enerji Şirkəti ilə Tərəfdaşlıq',
'Caspian Industry has signed a strategic partnership agreement with a leading international energy company. This collaboration will bring cutting-edge technology and expertise to our operations. Together, we will develop innovative solutions for the energy sector and contribute to sustainable development in the region.',
'Caspian Industry подписала соглашение о стратегическом партнерстве с ведущей международной энергетической компанией. Это сотрудничество принесет передовые технологии и опыт в наши операции. Вместе мы разработаем инновационные решения для энергетического сектора и внесем вклад в устойчивое развитие региона.',
'Caspian Industry aparıcı beynəlxalq enerji şirkəti ilə strateji tərəfdaşlıq müqaviləsi imzaladı. Bu əməkdaşlıq əməliyyatlarımıza ən müasir texnologiya və təcrübə gətirəcək. Birlikdə enerji sektoru üçün innovativ həllər hazırlayacağıq və regionda davamlı inkişafa töhfə verəcəyik.',
'Strategic partnership brings new opportunities', 'Стратегическое партнерство открывает новые возможности', 'Strateji tərəfdaşlıq yeni imkanlar açır',
'2024-10-15', 1),

('Industry Safety Award 2024', 'Награда за безопасность в отрасли 2024', '2024 Sənaye Təhlükəsizliyi Mükafatı',
'We are proud to receive the Industry Safety Excellence Award 2024. This recognition reflects our commitment to maintaining the highest safety standards in all our operations. Our comprehensive safety program includes regular training, advanced monitoring systems, and strict adherence to international standards.',
'Мы гордимся получением награды за выдающиеся достижения в области безопасности в отрасли 2024 года. Это признание отражает нашу приверженность поддержанию высочайших стандартов безопасности во всех наших операциях. Наша комплексная программа безопасности включает регулярное обучение, передовые системы мониторинга и строгое соблюдение международных стандартов.',
'2024-cü il üçün Sənaye Təhlükəsizliyi Mükəmməllik Mükafatını almaqdan qürur duyuruq. Bu tanınma bütün əməliyyatlarımızda ən yüksək təhlükəsizlik standartlarının saxlanması öhdəliyimizi əks etdirir. Hərtərəfli təhlükəsizlik proqramımız müntəzəm təlimləri, qabaqcıl monitorinq sistemlərini və beynəlxalq standartlara ciddi riayət edilməsini əhatə edir.',
'Recognition for excellence in safety standards', 'Признание за превосходные стандарты безопасности', 'Təhlükəsizlik standartlarında mükəmməlliyə görə tanınma',
'2024-09-20', 1);

-- Sample Projects
INSERT INTO projects (title_en, title_ru, title_az, description_en, description_ru, description_az, client, location, completion_date, sort_order, is_published) VALUES
('Offshore Platform Construction', 'Строительство морской платформы', 'Açıq Dəniz Platformasının Tikintisi',
'Complete construction and installation of offshore oil platform with state-of-the-art technology. The project includes drilling equipment, processing facilities, and accommodation modules for 200 personnel. Features advanced safety systems, environmental protection measures, and modern communication infrastructure.',
'Полное строительство и установка морской нефтяной платформы с использованием новейших технологий. Проект включает буровое оборудование, перерабатывающие мощности и жилые модули на 200 человек. Включает передовые системы безопасности, меры защиты окружающей среды и современную коммуникационную инфраструктуру.',
'Ən müasir texnologiya ilə açıq dəniz neft platformasının tam tikintisi və quraşdırılması. Layihə 200 işçi üçün qazma avadanlığı, emal obyektləri və yaşayış modullarını əhatə edir. Qabaqcıl təhlükəsizlik sistemləri, ətraf mühitin qorunması tədbirləri və müasir kommunikasiya infrastrukturu daxildir.',
'National Oil Company', 'Caspian Sea', '2024-08-15', 1, 1),

('Pipeline Infrastructure Development', 'Развитие трубопроводной инфраструктуры', 'Boru Kəməri İnfrastrukturunun İnkişafı',
'Design and construction of 150km pipeline system connecting major production facilities. Features advanced monitoring systems and environmental protection measures. The project includes pumping stations, control systems, and comprehensive safety infrastructure.',
'Проектирование и строительство 150-км системы трубопроводов, соединяющей основные производственные объекты. Включает передовые системы мониторинга и меры защиты окружающей среды. Проект включает насосные станции, системы управления и комплексную инфраструктуру безопасности.',
'Əsas istehsal obyektlərini birləşdirən 150 km boru kəməri sisteminin layihələndirilməsi və tikintisi. Qabaqcıl monitorinq sistemləri və ətraf mühitin qorunması tədbirləri var. Layihəyə nasos stansiyaları, idarəetmə sistemləri və hərtərəfli təhlükəsizlik infrastrukturu daxildir.',
'Trans-Caspian Energy', 'Azerbaijan-Georgia', '2024-12-30', 2, 1),

('Refinery Modernization', 'Модернизация нефтеперерабатывающего завода', 'Neft Emalı Zavodunun Modernləşdirilməsi',
'Comprehensive upgrade of existing refinery facilities to meet European environmental standards. Includes new processing units and waste management systems. The modernization will increase capacity by 40% while reducing emissions by 50%.',
'Комплексная модернизация существующих нефтеперерабатывающих мощностей для соответствия европейским экологическим стандартам. Включает новые перерабатывающие установки и системы управления отходами. Модернизация увеличит мощность на 40% при одновременном сокращении выбросов на 50%.',
'Avropa ekoloji standartlarına cavab vermək üçün mövcud neft emalı müəssisələrinin hərtərəfli təkmilləşdirilməsi. Yeni emal qurğuları və tullantıların idarə edilməsi sistemləri daxildir. Modernləşdirmə gücü 40% artıracaq və eyni zamanda emissiyaları 50% azaldacaq.',
'Baku Oil Refinery', 'Baku, Azerbaijan', '2025-03-20', 3, 1),

('Industrial Equipment Supply', 'Поставка промышленного оборудования', 'Sənaye Avadanlığının Təchizatı',
'Supply and installation of advanced industrial equipment for major production facility. Includes turbines, compressors, and control systems. All equipment meets international quality and safety standards.',
'Поставка и установка передового промышленного оборудования для крупного производственного объекта. Включает турбины, компрессоры и системы управления. Все оборудование соответствует международным стандартам качества и безопасности.',
'Böyük istehsal obyekti üçün qabaqcıl sənaye avadanlığının təchizatı və quraşdırılması. Turbinlər, kompressorlar və idarəetmə sistemləri daxildir. Bütün avadanlıq beynəlxalq keyfiyyət və təhlükəsizlik standartlarına cavab verir.',
'Industrial Manufacturing Corp', 'Sumgait, Azerbaijan', '2024-06-10', 4, 1);

-- Sample Partners (Note: You'll need to add actual logo images later)
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
'We provide comprehensive solutions for oil & gas industry including offshore platform construction, pipeline infrastructure, refinery services, and industrial equipment supply. Our services cover the entire project lifecycle from design to commissioning.',
'Мы предоставляем комплексные решения для нефтегазовой отрасли, включая строительство морских платформ, инфраструктуру трубопроводов, услуги НПЗ и поставку промышленного оборудования. Наши услуги охватывают весь жизненный цикл проекта от проектирования до ввода в эксплуатацию.',
'Biz neft və qaz sənayesi üçün açıq dəniz platformalarının tikintisi, boru kəməri infrastrukturu, neft emalı xidmətləri və sənaye avadanlığı təchizatı daxil olmaqla hərtərəfli həllər təqdim edirik. Xidmətlərimiz layihənin layihələşdirmədən istifadəyə verilməsinə qədər bütün həyat dövrünü əhatə edir.',
1),

('Where are your main operations located?', 'Где расположены ваши основные операции?', 'Əsas əməliyyatlarınız harada yerləşir?',
'Our headquarters is in Baku, Azerbaijan, with project operations across the Caspian region including Azerbaijan, Kazakhstan, and Turkmenistan. We also have partnerships and projects in other regions.',
'Наша штаб-квартира находится в Баку, Азербайджан, с проектными операциями по всему Каспийскому региону, включая Азербайджан, Казахстан и Туркменистан. У нас также есть партнерства и проекты в других регионах.',
'Baş ofisimiz Bakı, Azərbaycandadır, layihə əməliyyatları Azərbaycan, Qazaxıstan və Türkmənistan daxil olmaqla Xəzər regionunda həyata keçirilir. Digər regionlarda da tərəfdaşlıqlarımız və layihələrimiz var.',
2),

('How can I request a quote?', 'Как я могу запросить расценки?', 'Təklif necə istəyə bilərəm?',
'You can request a quote by contacting us through our contact form, email at info@caspianindustry.com, or phone. Our team will respond within 24 hours with detailed information and pricing.',
'Вы можете запросить расценки, связавшись с нами через контактную форму, электронную почту info@caspianindustry.com или телефон. Наша команда ответит в течение 24 часов с подробной информацией и ценами.',
'Bizimlə əlaqə forması, info@caspianindustry.com e-poçt və ya telefon vasitəsilə əlaqə saxlayaraq təklif istəyə bilərsiniz. Komandamız 24 saat ərzində ətraflı məlumat və qiymətlərlə cavab verəcək.',
3),

('Do you offer maintenance services?', 'Предлагаете ли вы услуги по техническому обслуживанию?', 'Texniki xidmət göstərirsinizmi?',
'Yes, we provide comprehensive maintenance and support services for all equipment and installations we supply. Our service includes regular inspections, preventive maintenance, emergency repairs, and 24/7 technical support.',
'Да, мы предоставляем комплексные услуги по техническому обслуживанию и поддержке для всего оборудования и установок, которые мы поставляем. Наш сервис включает регулярные проверки, профилактическое обслуживание, аварийный ремонт и круглосуточную техническую поддержку.',
'Bəli, biz tədarük etdiyimiz bütün avadanlıq və qurğular üçün hərtərəfli texniki xidmət və dəstək xidmətləri göstəririk. Xidmətimizə müntəzəm yoxlamalar, profilaktik texniki xidmət, təcili təmirlər və 24/7 texniki dəstək daxildir.',
4),

('What are your quality standards?', 'Каковы ваши стандарты качества?', 'Keyfiyyət standartlarınız nədir?',
'We adhere to international quality standards including ISO 9001, ISO 14001, and OHSAS 18001. All our projects undergo rigorous quality control and safety inspections to ensure the highest standards.',
'Мы придерживаемся международных стандартов качества, включая ISO 9001, ISO 14001 и OHSAS 18001. Все наши проекты проходят строгий контроль качества и проверки безопасности для обеспечения высочайших стандартов.',
'Biz ISO 9001, ISO 14001 və OHSAS 18001 daxil olmaqla beynəlxalq keyfiyyət standartlarına riayət edirik. Bütün layihələrimiz ən yüksək standartları təmin etmək üçün ciddi keyfiyyət nəzarəti və təhlükəsizlik yoxlamalarından keçir.',
5);

-- Sample Gallery Items
INSERT INTO gallery (title_en, title_ru, title_az, image, description_en, description_ru, description_az, sort_order) VALUES
('Offshore Platform', 'Морская платформа', 'Açıq Dəniz Platforması', 'gallery-1.jpg', 'Oil platform construction in the Caspian Sea', 'Строительство нефтяной платформы в Каспийском море', 'Xəzər dənizində neft platformasının tikintisi', 1),
('Pipeline Construction', 'Строительство трубопровода', 'Boru Kəməri Tikintisi', 'gallery-2.jpg', 'Pipeline infrastructure development project', 'Проект развития инфраструктуры трубопровода', 'Boru kəməri infrastrukturunun inkişafı layihəsi', 2),
('Refinery Facility', 'Нефтеперерабатывающий завод', 'Neft Emalı Zavodu', 'gallery-3.jpg', 'Modern refinery plant operations', 'Операции современного нефтеперерабатывающего завода', 'Müasir neft emalı zavodunun əməliyyatları', 3),
('Team at Work', 'Команда за работой', 'İşdə Komanda', 'gallery-4.jpg', 'Our professional team on site', 'Наша профессиональная команда на объекте', 'Sahədə peşəkar komandamız', 4),
('Industrial Equipment', 'Промышленное оборудование', 'Sənaye Avadanlığı', 'gallery-5.jpg', 'High-tech industrial equipment installation', 'Установка высокотехнологичного промышленного оборудования', 'Yüksək texnoloji sənaye avadanlığının quraşdırılması', 5),
('Quality Control', 'Контроль качества', 'Keyfiyyətə Nəzarət', 'gallery-6.jpg', 'Quality assurance and inspection process', 'Процесс обеспечения качества и инспекции', 'Keyfiyyət təminatı və yoxlama prosesi', 6);
