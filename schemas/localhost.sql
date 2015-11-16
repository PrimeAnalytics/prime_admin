-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2015 at 11:38 PM
-- Server version: 10.1.6-MariaDB
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_primeanalytics`
--

-- --------------------------------------------------------

--
-- Table structure for table `test table`
--

CREATE TABLE IF NOT EXISTS `test table` (
  `column1` int(11) NOT NULL,
  `column2` int(11) NOT NULL,
  `column3` int(11) NOT NULL,
  `column4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test table 2`
--

CREATE TABLE IF NOT EXISTS `test table 2` (
  `column5` int(11) NOT NULL,
  `column6` int(11) NOT NULL,
  `column7` int(11) NOT NULL,
  `column8` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Database: `db_stellenbosch`
--
--
-- Database: `db_testorg`
--
--
-- Database: `prime_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE IF NOT EXISTS `dashboard` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(45) NOT NULL,
  `icon` varchar(45) NOT NULL,
  `weight` int(11) NOT NULL,
  `organisation_id` int(10) unsigned NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `parameters` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id`, `title`, `icon`, `weight`, `organisation_id`, `type`, `parameters`) VALUES
(14, 'Advertiser Overview', 'fa-adn', 0, 1, 'Default', '{"orgimg":"\\r\\n\\t\\t\\/files\\/17logo-light.png\\r\\n","logo":"\\r\\n\\t\\t\\/files\\/18logo.png\\r\\n"}'),
(15, 'Advertiser Layout 2', 'fa-android', 0, 1, 'Default', '{"orgimg":"\\r\\n\\t\\t\\/files\\/19Tims Logo Light.jpg\\r\\n","logo":"\\r\\n\\t\\t\\/files\\/20Tims Logo Light.jpg\\r\\n"}'),
(16, 'Overview', 'fa-archive', 0, 1, 'Default', '{"orgimg":"\\r\\n\\t\\t\\/files\\/214.png\\r\\n","logo":"\\r\\n\\t\\t\\/files\\/2154.png\\r\\n"}'),
(17, 'Sandtone', 'fa-adjust', 0, 1, 'Default', '{"orgimg":"\\r\\n\\t\\t\\/files\\/2160logo.png\\r\\n"}');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_has_users`
--

CREATE TABLE IF NOT EXISTS `dashboard_has_users` (
  `dashboard_id` int(10) unsigned NOT NULL,
  `users_email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dashboard_has_users`
--

INSERT INTO `dashboard_has_users` (`dashboard_id`, `users_email`) VALUES
(14, 'calvin@primeanalytics.io'),
(14, 'christopher@primeanalytics.io'),
(14, 'support@primeanalytics.io'),
(14, 'test@primeanalytics.io'),
(15, 'calvin@primeanalytics.io'),
(15, 'christopher@primeanalytics.io'),
(15, 'support@primeanalytics.io'),
(15, 'test@primeanalytics.io'),
(16, 'calvin@primeanalytics.io'),
(16, 'christopher@primeanalytics.io'),
(16, 'support@primeanalytics.io'),
(16, 'test@primeanalytics.io'),
(17, 'support@primeanalytics.io');

-- --------------------------------------------------------

--
-- Table structure for table `data_connector`
--

CREATE TABLE IF NOT EXISTS `data_connector` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `parameters` varchar(2000) DEFAULT NULL,
  `storage` varchar(2000) DEFAULT NULL,
  `organisation_id` int(10) unsigned NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `table` varchar(45) DEFAULT NULL,
  `column` varchar(45) DEFAULT NULL,
  `default_value` varchar(45) DEFAULT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `organisation_id` int(10) unsigned NOT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `name`, `table`, `column`, `default_value`, `operator`, `organisation_id`, `type`) VALUES
(5, 'Advertiser Filter', 'marketing', 'advertiser_name', '', '=', 1, 'where'),
(6, 'Campaign Names', 'marketing', 'campaign_name', '', '=', 1, 'where'),
(7, 'Placement Names', 'marketing', 'placement_name', '', '=', 1, 'where'),
(8, 'Country Names', 'marketing', 'country_name', '', '=', 1, 'where'),
(9, 'Site Name', 'marketing', 'site_name', '', '=', 1, 'where'),
(10, 'Placement SIze', 'marketing', 'placement_size', '', '=', 1, 'where'),
(11, 'Date Select', 'marketing', 'date_trunc(''week''|date)', '', '=', 1, 'where');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `parameters` longtext,
  `organisation_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `org_database`
--

CREATE TABLE IF NOT EXISTS `org_database` (
  `id` int(10) unsigned NOT NULL,
  `db_host` varchar(45) DEFAULT NULL,
  `db_username` varchar(45) DEFAULT NULL,
  `db_password` varchar(45) DEFAULT NULL,
  `db_name` varchar(45) DEFAULT NULL,
  `organisation_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `org_database`
--

INSERT INTO `org_database` (`id`, `db_host`, `db_username`, `db_password`, `db_name`, `organisation_id`) VALUES
(5, 'localhost', 'admin_PrimeAnalytics', '4cec04d3fffe952728e63871e875e5bc0c5dda7c', 'db_primeanalytics', 1),
(6, 'localhost', 'admin_Stellenbosch', 'b94f3b709a3dab22e512b551ed4dbe7c59911ccc', 'db_Stellenbosch', 2),
(7, 'localhost', 'admin_Stellenbosch', '8cb2237d0679ca88db6464eac60da96345513964', 'db_Stellenbosch', 3),
(8, 'localhost', 'admin_TestOrg', '4cec04d3fffe952728e63871e875e5bc0c5dda7c', 'db_TestOrg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE IF NOT EXISTS `organisation` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `theme` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`id`, `name`, `theme`, `url`) VALUES
(1, 'PrimeAnalytics', 'pages', NULL),
(2, 'Stellenbosch', 'make', NULL),
(3, 'Stellenbosch', 'make', NULL),
(4, 'TestOrg', 'make', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `company_registered_name` varchar(45) DEFAULT NULL,
  `registration_number` varchar(45) DEFAULT NULL,
  `vat_number` varchar(45) DEFAULT NULL,
  `payment_method` enum('credit card','debit order') DEFAULT NULL,
  `billing_contact` varchar(45) DEFAULT NULL,
  `organisation_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `physical_address`
--

CREATE TABLE IF NOT EXISTS `physical_address` (
  `id` int(10) unsigned NOT NULL,
  `address` varchar(200) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `organisation_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `portlet`
--

CREATE TABLE IF NOT EXISTS `portlet` (
  `id` int(10) unsigned NOT NULL,
  `type` varchar(45) NOT NULL,
  `column` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `dashboard_id` int(10) unsigned NOT NULL,
  `parameters` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portlet`
--

INSERT INTO `portlet` (`id`, `type`, `column`, `row`, `dashboard_id`, `parameters`) VALUES
(27, 'color_portlet', 0, 1, 14, '{"width":"col-md-6","title":"Placements","color":"#efefef"}'),
(28, 'separator_portlet', 1, 1, 14, '{"width":"col-md-6","title":"Country Name","color":"#94fffc"}'),
(29, 'basic_portlet', 0, 2, 14, '{"width":"col-md-6","title":"Site Name","color":"#10206b"}'),
(30, 'basic_portlet', 1, 2, 14, '{"width":"col-md-6","title":"Placement Size","color":"#f07818"}'),
(31, 'basic_portlet', 2, 0, 14, '{"width":"col-md-12","title":"Overview","color":"#ffd464"}'),
(32, 'color_portlet', 0, 0, 15, '{"width":"col-md-12","title":"","color":"#fdfdfd"}'),
(33, 'basic_portlet', 0, 1, 15, '{"width":"col-md-6","title":"Country","color":"#3a9ad9"}'),
(34, 'separator_portlet', 1, 1, 15, '{"width":"col-md-6","title":"Overview","color":"#bff073"}'),
(35, 'separator_portlet', 0, 2, 15, '{"width":"col-md-12","title":"Placements","color":"#f7ff3f"}'),
(36, 'separator_portlet', 0, 0, 16, '{"width":"col-md-8","title":"Overview","color":"#ffa200"}'),
(37, 'basic_portlet', 1, 0, 16, '{"width":"col-md-4","title":"","color":"#ff85cb"}'),
(41, 'clean', 0, 0, 17, '{"width":"col-md-12","title":"Country"}'),
(44, 'clean', 1, 0, 17, '{"width":"col-md-12","title":"Campaigns"}'),
(45, 'tabbed_portlet', 0, 4, 17, '{"width":"col-md-12","title":"Overview","tabs":"Revenue,Clicks,Impressions,Profit"}'),
(47, 'grouped_list', 0, 6, 17, '{"width":"col-md-12","tabs":"Advertisers,Countries,Campaigns,Placement,Site,Size"}'),
(48, 'tabbed_portlet', 1, 0, 14, '{"width":"col-md-12","title":"Tabed one","tabs":"Clicks,Revenue,Impressions,Revenue"}');

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE IF NOT EXISTS `process` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `parameters` longtext,
  `storage` longtext,
  `organisation_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`id`, `name`, `parameters`, `storage`, `organisation_id`) VALUES
(5, 'Tweets', '{"columns":"avg(tri):avg(tri)","table":"finance","rows":"fundreportingdescription,date_format(date_trunc(''month''|dividenddeclarationdate)):date"}', '', 1),
(6, 'fundselect', '{"columns":"avg(tri)","table":"finance","rows":"fundreportingdescription,date_format(date_trunc(''month''|dividenddeclarationdate)):date"}', '', 1),
(7, 'Marketing', '{"columns":"sum(impressions):impressions,sum(revenue):revenue,sum(clicks):clicks,sum(planned_cost):budget,sum(revenue)/sum(planned_cost):fraction spent,(sum(revenue)/sum(impressions)):cpi","table":"marketing","rows":"advertiser_name:advertiser name,campaign_name:campaign name,placement_name,date_format(date):date"}', '', 1),
(8, 'Campaign', '{"columns":"sum(impressions):impressions,sum(revenue):revenue,sum(clicks):clicks,sum(planned_cost):budget,sum(revenue)/sum(planned_cost):fraction spent","table":"marketing","rows":"advertiser_name:advertiser name,campaign_name:campaign name"}', '', 1),
(9, 'Creative', '{"columns":"sum(impressions):impressions,sum(revenue):revenue,sum(clicks):clicks,sum(planned_cost):budget,sum(revenue)/sum(planned_cost):fraction spent","table":"marketing","rows":"advertiser_name:advertiser name,date_format(date):date"}', '', 1),
(10, 'Advertiser Names', '{"columns":"sum(revenue):revenue,sum(clicks):clicks,sum(impressions):impressions,sum(planned_cost):planned cost","table":"marketing","rows":"advertiser_name"}', '', 1),
(11, 'Advertiser Overview', '{"columns":"sum(impressions):impressions,sum(clicks):clicks,sum(revenue):revenue,sum(planned_cost):budget","table":"marketing","rows":"date_format(date_trunc(''week''|date)):date"}', '', 1),
(12, 'Campaign Names', '{"columns":"sum(revenue):revenue,sum(clicks):clicks,sum(impressions):impressions,sum(planned_cost):planned cost","table":"marketing","rows":"campaign_name"}', '', 1),
(13, 'Placement Names', '{"columns":"sum(revenue):revenue,sum(clicks):clicks,sum(impressions):impressions,sum(planned_cost):planned cost","table":"marketing","rows":"placement_name"}', '', 1),
(14, 'Country Names', '{"columns":"sum(revenue):revenue,sum(clicks):clicks,sum(impressions):impressions,sum(planned_cost):planned cost","table":"marketing","rows":"country_name"}', '', 1),
(15, 'Placement SIze', '{"columns":"sum(revenue):revenue,sum(clicks):clicks,sum(impressions):impressions,sum(planned_cost):planned cost","table":"marketing","rows":"placement_size"}', '', 1),
(16, 'Site Name', '{"columns":"sum(revenue):revenue,sum(clicks):clicks,sum(impressions):impressions,sum(planned_cost):planned cost","table":"marketing","rows":"site_name"}', '', 1),
(17, 'Plant Data', '{"columns":"sum(sales_quantity),sum(collection_value),sum(competitive_adjustment),sum(list_price_adjustment),max(competitive_adjustment)","table":"plant_name","rows":"concat(round(year)|''-''|round(period)):date"}', '', 1),
(18, 'Country Overview', '{"columns":"sum(clicks)","table":"marketing","rows":"date_format(date_trunc(''week''|date)):date,country_name"}', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `process_operator`
--

CREATE TABLE IF NOT EXISTS `process_operator` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` longtext,
  `category` varchar(45) DEFAULT NULL,
  `form` longtext,
  `script` longtext,
  `assemblies` longtext,
  `secondary_script` longtext,
  `accessibility` longtext,
  `icon` longtext,
  `organisation_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `process_operator`
--

INSERT INTO `process_operator` (`id`, `name`, `description`, `category`, `form`, `script`, `assemblies`, `secondary_script`, `accessibility`, `icon`, `organisation_id`) VALUES
(14, 'CSV Import', 'hello', 'Import', '', 'using DiagramDesigner;\r\nusing OperatorInterface;\r\nusing System;\r\nusing System.Data;\r\nusing System.Collections.Generic;\r\nusing System.Linq;\r\nusing System.Text;\r\nusing System.Windows.Input;\r\n\r\n\r\n    public class Script\r\n    {\r\n\r\n    public static string GetName()\r\n    {\r\n        return "CSV Import";\r\n    }\r\n\r\n    public static Dictionary<string, Dictionary<string, string>> GetParameters()\r\n        {\r\n            Dictionary<string, Dictionary<string, string>> parameters = new Dictionary<string, Dictionary<string, string>>();\r\n\r\n            Dictionary<string, string> filePath = new Dictionary<string, string>();\r\n\r\n            filePath.Add("type", "fileSelect");\r\n            filePath.Add("label", "File Path:");\r\n            filePath.Add("value", @"C:\\Users\\Enrico\\data.csv");\r\n\r\n            parameters.Add("File Path", filePath);\r\n\r\n        return parameters;\r\n        }\r\n\r\n        public static DataTable Execute(List<DataTable> input, Dictionary<string, Dictionary<string, string>> parameters)\r\n        {\r\n            DataTable dt = new DataTable();\r\n            string[] fields = null;\r\n            int i = 0;\r\n            foreach (string csvRow in System.IO.File.ReadLines(parameters["File Path"]["value"]))\r\n            {\r\n                fields = csvRow.Split('','');\r\n                if (i == 0)\r\n                {\r\n                    foreach (string field in fields)\r\n                    {\r\n                        dt.Columns.Add(field);\r\n                    }\r\n                    \r\n                }\r\n                else\r\n                {\r\n                    DataRow row = dt.NewRow();\r\n                    row.ItemArray = fields;\r\n                    dt.Rows.Add(row);\r\n                }\r\n                i++;\r\n            }\r\n\r\n\r\n            return dt;\r\n        }\r\n\r\n    }\r\n\r\n', '', '', '', '', 1),
(15, 'CSV Import2', 'dsfdadfdfdsfsdf', 'Export', '', 'using DiagramDesigner;\r\nusing OperatorInterface;\r\nusing System;\r\nusing System.Data;\r\nusing System.Collections.Generic;\r\nusing System.Linq;\r\nusing System.Text;\r\nusing System.Windows.Input;\r\n\r\n\r\n    public class Script\r\n    {\r\n\r\n    public static string GetName()\r\n    {\r\n        return "Aggregate";\r\n    }\r\n\r\n    public static Dictionary<string, Dictionary<string, string>> GetParameters()\r\n        {\r\n            Dictionary<string, Dictionary<string, string>> parameters = new Dictionary<string, Dictionary<string, string>>();\r\n\r\n            Dictionary<string, string> filePath = new Dictionary<string, string>();\r\n\r\n            filePath.Add("type", "input");\r\n            filePath.Add("label", "File Path:");\r\n            filePath.Add("value", @"C:\\Users\\Enrico\\data.csv");\r\n\r\n            parameters.Add("File Path", filePath);\r\n\r\n        return parameters;\r\n        }\r\n\r\n        public static DataTable Execute(List<DataTable> input, Dictionary<string, Dictionary<string, string>> parameters)\r\n        {\r\n            DataTable dt = new DataTable();\r\n            string[] fields = null;\r\n            int i = 0;\r\n            foreach (string csvRow in System.IO.File.ReadLines(parameters["File Path"]["value"]))\r\n            {\r\n                fields = csvRow.Split('','');\r\n                if (i == 0)\r\n                {\r\n                    foreach (string field in fields)\r\n                    {\r\n                        dt.Columns.Add(field);\r\n                    }\r\n                    \r\n                }\r\n                else\r\n                {\r\n                    DataRow row = dt.NewRow();\r\n                    row.ItemArray = fields;\r\n                    dt.Rows.Add(row);\r\n                }\r\n                i++;\r\n            }\r\n\r\n\r\n            return dt;\r\n        }\r\n\r\n    }\r\n\r\n', '', '', '', '', 1),
(16, 'CSV Import3', 'This operator multiplys everything by two', 'Evaluation', '', 'using DiagramDesigner;\r\nusing OperatorInterface;\r\nusing System;\r\nusing System.Data;\r\nusing System.Collections.Generic;\r\nusing System.Linq;\r\nusing System.Text;\r\nusing System.Windows.Input;\r\n\r\n\r\n    public class Script\r\n    {\r\n\r\n    public static string GetName()\r\n    {\r\n        return "k-NN";\r\n    }\r\n\r\n    public static Dictionary<string, Dictionary<string, string>> GetParameters()\r\n        {\r\n            Dictionary<string, Dictionary<string, string>> parameters = new Dictionary<string, Dictionary<string, string>>();\r\n\r\n            Dictionary<string, string> filePath = new Dictionary<string, string>();\r\n\r\n            filePath.Add("type", "input");\r\n            filePath.Add("label", "File Path:");\r\n            filePath.Add("value", @"C:\\Users\\Enrico\\data.csv");\r\n\r\n            parameters.Add("File Path", filePath);\r\n\r\n        return parameters;\r\n        }\r\n\r\n        public static DataTable Execute(List<DataTable> input, Dictionary<string, Dictionary<string, string>> parameters)\r\n        {\r\n            DataTable dt = new DataTable();\r\n            string[] fields = null;\r\n            int i = 0;\r\n            foreach (string csvRow in System.IO.File.ReadLines(parameters["File Path"]["value"]))\r\n            {\r\n                fields = csvRow.Split('','');\r\n                if (i == 0)\r\n                {\r\n                    foreach (string field in fields)\r\n                    {\r\n                        dt.Columns.Add(field);\r\n                    }\r\n                    \r\n                }\r\n                else\r\n                {\r\n                    DataRow row = dt.NewRow();\r\n                    row.ItemArray = fields;\r\n                    dt.Rows.Add(row);\r\n                }\r\n                i++;\r\n            }\r\n\r\n\r\n            return dt;\r\n        }\r\n\r\n    }\r\n\r\n', '', '', '', '', 1),
(17, 'Aggregate', 'This operator performs the aggregation functions known from SQL. This operator provides a lot of functionalities in the same format as provided by the SQL aggregation functions. SQL aggregation functions and GROUP BY and HAVING clauses can be imitated using this operator.', 'Evaluation', '', 'using DiagramDesigner;\r\nusing OperatorInterface;\r\nusing System;\r\nusing System.Collections.Generic;\r\nusing System.Data;\r\nusing System.Linq;\r\nusing System.Text;\r\nusing System.Windows.Input;\r\n\r\n    public class Script\r\n    {\r\n\r\n    public static string GetName()\r\n    {\r\n        return "Aggregate";\r\n    }\r\n    public static Dictionary<string, Dictionary<string, string>> GetParameters()\r\n            {\r\n                Dictionary<string, Dictionary<string, string>> parameters = new Dictionary<string, Dictionary<string, string>>();\r\n\r\n                Dictionary<string, string> filePath = new Dictionary<string, string>();\r\n\r\n                filePath.Add("type", "input");\r\n                filePath.Add("label", "File Path:");\r\n                filePath.Add("value", "C:\\\\Users\\\\Enrico\\\\data.csv");\r\n\r\n                parameters.Add("File Path", filePath);\r\n\r\n                return parameters;\r\n            }\r\n\r\n            public static DataTable Execute(List<DataTable> input, Dictionary<string, Dictionary<string, string>> parameters)\r\n            {\r\n                DataTable dt = new DataTable();\r\n\r\n                return dt;\r\n            }\r\n\r\n    }', '', '', '', '', 1),
(18, 'ANOVA', 'This operator is used for comparison of performance vectors. It performs an analysis of variance (ANOVA) test to determine the probability for the null hypothesis i.e. ''the actual means are the same''.', 'Evaluation', '', 'using DiagramDesigner;\r\nusing OperatorInterface;\r\nusing System;\r\nusing System.Collections.Generic;\r\nusing System.Data;\r\nusing System.Linq;\r\nusing System.Text;\r\nusing System.Windows.Input;\r\n\r\n    public class Script\r\n    {\r\n\r\n    public static string GetName()\r\n    {\r\n        return "ANOVA";\r\n    }\r\n    public static Dictionary<string, Dictionary<string, string>> GetParameters()\r\n            {\r\n                Dictionary<string, Dictionary<string, string>> parameters = new Dictionary<string, Dictionary<string, string>>();\r\n\r\n                Dictionary<string, string> filePath = new Dictionary<string, string>();\r\n\r\n                filePath.Add("type", "input");\r\n                filePath.Add("label", "File Path:");\r\n                filePath.Add("value", "C:\\\\Users\\\\Enrico\\\\data.csv");\r\n\r\n                parameters.Add("File Path", filePath);\r\n\r\n                return parameters;\r\n            }\r\n\r\n            public static DataTable Execute(List<DataTable> input, Dictionary<string, Dictionary<string, string>> parameters)\r\n            {\r\n                DataTable dt = new DataTable();\r\n\r\n                return dt;\r\n            }\r\n\r\n    }', '', '', '', '', 1),
(19, 'Read Excel', 'This operator reads an ExampleSet from the specified Excel file.', 'Import', '', 'using DiagramDesigner;\r\nusing OperatorInterface;\r\nusing System;\r\nusing System.Collections.Generic;\r\nusing System.Data;\r\nusing System.Linq;\r\nusing System.Text;\r\nusing System.Windows.Input;\r\n\r\n    public class Script\r\n    {\r\n\r\n    public static string GetName()\r\n    {\r\n        return "Read Excel";\r\n    }\r\n    public static Dictionary<string, Dictionary<string, string>> GetParameters()\r\n            {\r\n                Dictionary<string, Dictionary<string, string>> parameters = new Dictionary<string, Dictionary<string, string>>();\r\n\r\n                Dictionary<string, string> filePath = new Dictionary<string, string>();\r\n\r\n                filePath.Add("type", "fileSelect");\r\n                filePath.Add("label", "File Path:");\r\n                filePath.Add("value", "C:\\\\Users\\\\Enrico\\\\data.csv");\r\n\r\n                parameters.Add("File Path", filePath);\r\n\r\n                return parameters;\r\n            }\r\n\r\n            public static DataTable Execute(List<DataTable> input, Dictionary<string, Dictionary<string, string>> parameters)\r\n            {\r\n                DataTable dt = new DataTable();\r\n\r\n                return dt;\r\n            }\r\n\r\n    }', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `process_scheduled`
--

CREATE TABLE IF NOT EXISTS `process_scheduled` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `parameters` longtext,
  `storage` longtext,
  `organisation_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `theme_dashboard`
--

CREATE TABLE IF NOT EXISTS `theme_dashboard` (
  `id` int(10) unsigned NOT NULL,
  `html` longtext,
  `js` longtext,
  `css` longtext,
  `script` longtext,
  `style` longtext,
  `form` longtext,
  `theme_layout_id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme_dashboard`
--

INSERT INTO `theme_dashboard` (`id`, `html`, `js`, `css`, `script`, `style`, `form`, `theme_layout_id`, `name`, `image`) VALUES
(3, '<body class="fixed-header   ">\n    <!-- BEGIN SIDEBPANEL-->\n    <nav class="page-sidebar" data-pages="sidebar">\n      <!-- BEGIN SIDEBAR MENU HEADER-->\n      <div class="sidebar-header">\n        <img src="{{parm[''orgimg'']}}" alt="logo" class="brand" data-src="{{parm[''orgimg'']}}" data-src-retina="{{parm[''orgimg'']}}" width="78" ><div class="sidebar-header-controls">\n          <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu">\n          </button>\n          <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>\n          </button>\n        </div>\n      </div>\n      <!-- END SIDEBAR MENU HEADER-->\n      <!-- START SIDEBAR MENU -->\n      <div class="sidebar-menu">\n        <!-- BEGIN SIDEBAR MENU ITEMS-->\n        <ul class="menu-items">\n            {%for link in  menu %}\n\n\n<li class="">\n            <a href="{{link[''link'']}}">\n              <span class="title">{{link[''title'']}}</span>\n            </a>\n            <span class="icon-thumbnail"><i class="fa {{link[''icon'']}}"></i></span>\n          </li>\n          \n          {% endfor %}\n\n        </ul>\n<div class="clearfix"></div>\n      </div>\n      <!-- END SIDEBAR MENU -->\n    </nav><!-- END SIDEBAR --><!-- END SIDEBPANEL--><!-- START PAGE-CONTAINER --><div class="page-container">\n      <!-- START HEADER -->\n      <div class="header ">\n        <!-- START MOBILE CONTROLS -->\n        <!-- LEFT SIDE -->\n        <div class="pull-left full-height visible-sm visible-xs">\n          <!-- START ACTION BAR -->\n          <div class="sm-action-bar">\n            <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar">\n              <span class="icon-set menu-hambuger"></span>\n            </a>\n          </div>\n          <!-- END ACTION BAR -->\n        </div>\n        <!-- END MOBILE CONTROLS -->\n        <div class=" pull-left sm-table">\n          <div class="header-inner">\n            <div class="brand inline">\n              <img src="{{parm[''logo'']}}" alt="logo" data-src="{{parm[''logo'']}}" data-src-retina="{{parm[''logo'']}}" width="78" >\n</div>\n</div>\n        </div>\n\n        <div class=" pull-right">\n          <!-- START User Info-->\n          <div class="visible-lg visible-md m-t-10">\n            <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">\n              <span class="semi-bold">{{username}}</span>\n            </div>\n            <div class="dropdown pull-right">\n              <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n                <span class="thumbnail-wrapper d32 circular inline m-t-5">\n                <img src="{{userimage}}" alt="" data-src="{{userimage}}" data-src-retina="{{userimage}}" width="32" height="32"></span>\n              </button>\n              <ul class="dropdown-menu profile-dropdown" role="menu">\n                <li class="bg-master-lighter">\n                  <a href="{{logout}}" class="clearfix">\n                    <span class="pull-left">Logout</span>\n                    <span class="pull-right"><i class="pg-power"></i></span>\n                  </a>\n                </li>\n              </ul>\n</div>\n          </div>\n          <!-- END User Info-->\n        </div>\n      </div>\n      <!-- END HEADER -->\n      <!-- START PAGE CONTENT WRAPPER -->\n      <div class="page-content-wrapper">\n        <!-- START PAGE CONTENT -->\n        <div class="content">\n          \n                    <div class="container-fluid"><div class="row">\n{{region[''0'']}}\n</div></div>\n<div class="container-fluid"><div class="row">\n{{region[''1'']}}\n</div></div>\n<div class="container-fluid"><div class="row">\n{{region[''2'']}}\n</div></div>\n<div class="container-fluid"><div class="row">\n{{region[''3'']}}\n</div></div>\n<div class="container-fluid"><div class="row">\n{{region[''4'']}}\n</div></div>\n<div class="container-fluid"><div class="row">\n{{region[''5'']}}\n</div></div>\n<div class="container-fluid"><div class="row">\n{{region[''6'']}}\n</div></div>\n<div class="container-fluid"><div class="row">\n{{region[''7'']}}\n</div></div>\n<div class="container-fluid"><div class="row">\n{{region[''8'']}}\n</div></div>\n<div class="container-fluid"><div class="row">\n{{region[''9'']}}\n</div></div>\n          \n        </div>\n        <!-- END PAGE CONTENT -->\n        <!-- START COPYRIGHT -->\n        <!-- START CONTAINER FLUID -->\n        <div class="container-fluid container-fixed-lg footer">\n          <div class="copyright sm-text-center">\n            <p class="small no-margin pull-left sm-pull-reset">\n              <span class="hint-text">Copyright © 2015 </span>\n              <span class="font-montserrat">Prime Analytics</span>.\n              <span class="hint-text">All rights reserved. </span>\n              <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>\n            </p>\n            <p class="small no-margin pull-right sm-pull-reset">\n              <a href="#">Hand-crafted</a> <span class="hint-text">&amp; Made with Love ®</span>\n            </p>\n            <div class="clearfix"></div>\n          </div>\n        </div>\n        <!-- END COPYRIGHT -->\n      </div>\n      <!-- END PAGE CONTENT WRAPPER -->\n    </div>\n    <!-- END PAGE CONTAINER -->\n    <!-- BEGIN VENDOR JS -->\n    <!-- END VENDOR JS --><!-- BEGIN CORE TEMPLATE JS --><!-- END CORE TEMPLATE JS --><!-- BEGIN PAGE LEVEL JS --><!-- END PAGE LEVEL JS -->\n</body>', '<script src="/themes/Pages/assets/assets/plugins/pace/pace.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery/jquery-1.11.1.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/modernizr.custom.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery-ui/jquery-ui.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/boostrapv3/js/bootstrap.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery/jquery-easy.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery-unveil/jquery.unveil.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery-bez/jquery.bez.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery-ios-list/jquery.ioslist.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery-actual/jquery.actual.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/bootstrap-select2/select2.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/classie/classie.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/switchery/js/switchery.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/nvd3/lib/d3.v3.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/nvd3/nv.d3.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/nvd3/src/utils.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/nvd3/src/tooltip.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/nvd3/src/interactiveLayer.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/nvd3/src/models/axis.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/nvd3/src/models/line.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/nvd3/src/models/lineWithFocusChart.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/mapplic/js/hammer.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/mapplic/js/jquery.mousewheel.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/mapplic/js/mapplic.js"></script>\r\n <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>\r\n<script src="/assets/global/plugins/morris/morris.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/rickshaw/rickshaw.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery-metrojs/MetroJs.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/skycons/skycons.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>\r\n<script src="/themes/Pages/assets/pages/js/pages.min.js"></script>\r\n<script src="/themes/Pages/assets/assets/js/dashboard.js"></script>\r\n<script src="/themes/Pages/assets/assets/js/scripts.js"></script>\r\n<script src="http://code.highcharts.com/highcharts.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>\r\n  <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>\r\n    <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>\r\n    <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>\r\n    <script type="text/javascript" src="/themes/Pages/assets/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>\r\n    <script type="text/javascript" src="/themes/Pages/assets/assets/plugins/datatables-responsive/js/lodash.min.js"></script>\r\n    <script src="https://code.highcharts.com/modules/funnel.js"></script>\r\n', '<link href="/themes/Pages/assets/pages/ico/60.png" rel="stylesheet">\r\n<link href="/themes/Pages/assets/pages/ico/76.png" rel="stylesheet">\r\n<link href="/themes/Pages/assets/pages/ico/120.png" rel="stylesheet">\r\n<link href="/themes/Pages/assets/pages/ico/152.png" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/mapplic/css/mapplic.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/assets/plugins/jquery-metrojs/MetroJs.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/pages/css/pages-icons.css" rel="stylesheet">\r\n<link href="/themes/Pages/assets/pages/css/pages.css" rel="stylesheet">', '', '', '[{"type":"parameters/image_upload","name":"orgimg","label":"Organisation Image"},{"type":"parameters/image_upload","name":"logo","label":"Logo"}]', 2, 'Default', '\n		/files/2156unnamed.jpg\n'),
(4, '<body class="">\r\n<!-- BEGIN HEADER -->\r\n<div class="header navbar navbar-inverse "> \r\n  <!-- BEGIN TOP NAVIGATION BAR -->\r\n  <div class="navbar-inner">\r\n	<div class="header-seperation"> \r\n		<ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">\r\n<li class="dropdown"> <a id="main-menu-toggle" href="#main-menu" class=""> <div class="iconset top-menu-toggle-white"></div> </a> </li>		 \r\n		</ul>\r\n<!-- BEGIN LOGO --><a href="#"><img src="{{parm[''orgimg'']}}" class="logo" alt="" data-src="{{parm[''orgimg'']}}" data-src-retina="{{parm[''orgimg'']}}" width="106" height="21"></a>\r\n      <!-- END LOGO --> \r\n      <ul class="nav pull-right notifcation-center">\r\n<li class="dropdown" id="header_task_bar"> <a href="#" class="dropdown-toggle active" data-toggle=""> <div class="iconset top-home"></div> </a> </li>\r\n		<li class="dropdown" id="portrait-chat-toggler" style="display:none"> <a href="#sidr" class="chat-menu-toggle"> <div class="iconset top-chat-white "></div> </a> </li>        \r\n      </ul>\r\n</div>\r\n      <!-- END RESPONSIVE MENU TOGGLER --> \r\n      <div class="header-quick-nav"> \r\n      <!-- BEGIN TOP NAVIGATION MENU -->\r\n	  <div class="pull-left"> \r\n        <ul class="nav quick-section">\r\n<li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle">\r\n            <div class="iconset top-menu-toggle-dark"></div>\r\n            </a> </li>\r\n        </ul>\r\n<ul class="nav quick-section">\r\n<li class="quicklinks"> <a href="#" class="">\r\n            <div class="iconset top-reload"></div>\r\n            </a> </li>\r\n          <li class="quicklinks"> <span class="h-seperate"></span>\r\n</li>\r\n          <li class="quicklinks"> <a href="#" class="">\r\n            <div class="iconset top-tiles"></div>\r\n            </a> </li>\r\n			<li class="m-r-10 input-prepend inside search-form no-boarder">\r\n				<span class="add-on"> <span class="iconset top-search"></span></span>\r\n				 <input name="" type="text" class="no-boarder " placeholder="Search Dashboard" style="width:250px;">\r\n</li>\r\n		  </ul>\r\n</div>\r\n	 <!-- END TOP NAVIGATION MENU -->\r\n	 \r\n	 <div class="pull-right"> \r\n		<div class="chat-toggler">	\r\n				<a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom" data-content="" data-toggle="dropdown" data-original-title="Notifications">\r\n					<div class="user-details"> \r\n						<div class="username">\r\n							{{username}}									\r\n						</div>						\r\n					</div> \r\n					<div class="iconset top-down-arrow"></div>\r\n				</a>	\r\n				<div class="profile-pic"> \r\n					<img src="{{userimage}}" alt="" data-src="{{userimage}}" data-src-retina="{{userimage}}" width="35" height="35"> \r\n				</div>       			\r\n			</div>\r\n		 <ul class="nav quick-section ">\r\n			<li class="quicklinks"> \r\n				<a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">						\r\n					<div class="iconset top-settings-dark "></div> 	\r\n				</a>\r\n				<ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">\r\n                  <li><a href="{{logout}}"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>\r\n               </ul>\r\n			</li> \r\n		</ul>\r\n      </div>\r\n      </div> \r\n      <!-- END TOP NAVIGATION MENU --> \r\n   \r\n  </div>\r\n  <!-- END TOP NAVIGATION BAR --> \r\n</div>\r\n<!-- END HEADER -->\r\n<!-- BEGIN CONTAINER -->\r\n<div class="page-container row-fluid">\r\n  <!-- BEGIN SIDEBAR -->\r\n  <div class="page-sidebar" id="main-menu"> \r\n  <!-- BEGIN MINI-PROFILE -->\r\n   <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper"> \r\n   <div class="user-info-wrapper">	\r\n	<div class="profile-wrapper">\r\n		<img src="{{userimage}}" alt="" data-src="{{userimage}}" data-src-retina="{{userimage}}" width="69" height="69">\r\n</div>\r\n    <div class="user-info">\r\n      <div class="greeting">Welcome</div>\r\n      <div class="username">{{username}}\r\n</div>\r\n      <div class="status">Status<a href="#"><div class="status-icon green"></div>Online</a>\r\n</div>\r\n    </div>\r\n   </div>\r\n  <!-- END MINI-PROFILE -->\r\n   \r\n   <!-- BEGIN SIDEBAR MENU -->	\r\n	<p class="menu-title">BROWSE <span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>\r\n    <ul>\r\n        {% for item in menu %} \r\n        <li class=""> <a href="{{item[''link'']}}"> <i class="fa {{item[''icon'']}}"></i> <span class="title">{{item[''title'']}}</span> </a> </li>  \r\n        {% endfor %}\r\n    </ul>\r\n	<div class="clearfix"></div>\r\n    <!-- END SIDEBAR MENU --> \r\n  </div>\r\n  </div>\r\n  <a href="#" class="scrollup">Scroll</a>\r\n   <div class="footer-widget">		\r\n	<div class="pull-right">\r\n		<div class="details-status">\r\n		<span data-animation-duration="560" data-value="86" class="animate-number"></span>%\r\n	</div>	\r\n	<a href="{{logout}}"><i class="fa fa-power-off"></i></a>\r\n</div>\r\n  </div>\r\n  <!-- END SIDEBAR --> \r\n  <!-- BEGIN PAGE CONTAINER-->\r\n  <div class="page-content"> \r\n    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->\r\n    <div id="portlet-config" class="modal hide">\r\n      <div class="modal-header">\r\n        <button data-dismiss="modal" class="close" type="button"></button>\r\n        <h3>Widget Settings</h3>\r\n      </div>\r\n      <div class="modal-body"> Widget settings form goes here </div>\r\n    </div>\r\n    <div class="clearfix"></div>\r\n    <div class="content">  \r\n<div class="row">\r\n    {{region[0]}}\r\n</div>\r\n<div class="row">\r\n    {{region[1]}}\r\n</div>\r\n<div class="row">\r\n    {{region[2]}}\r\n</div>\r\n<div class="row">\r\n    {{region[3]}}\r\n</div>\r\n<div class="row">\r\n    {{region[4]}}\r\n</div>\r\n<div class="row">\r\n    {{region[5]}}\r\n</div>\r\n<div class="row">\r\n    {{region[6]}}\r\n</div>\r\n<div class="row">\r\n    {{region[7]}}\r\n</div>\r\n<div class="row">\r\n    {{region[8]}}\r\n</div>\r\n<div class="row">\r\n    {{region[9]}}\r\n</div>\r\n\r\n\r\n    </div>\r\n  </div>\r\n </div>\r\n<!-- END CONTAINER --> \r\n\r\n<!-- END CONTAINER -->\r\n<!-- BEGIN CORE JS FRAMEWORK--> \r\n<!-- END CORE JS FRAMEWORK --><!-- BEGIN PAGE LEVEL JS --><!-- END PAGE LEVEL PLUGINS --><!-- BEGIN CORE TEMPLATE JS --><!-- END CORE TEMPLATE JS -->\r\n</body>', '<script src="/themes/WebArch/assets/plugins/jquery-1.8.3.min.js"></script>\r\n<script src="/themes/WebArch/assets/plugins/boostrapv3/js/bootstrap.min.js"></script>\r\n<script src="/themes/WebArch/assets/plugins/breakpoints.js"></script>\r\n<script src="/themes/WebArch/assets/plugins/jquery-unveil/jquery.unveil.min.js"></script>\r\n<script src="/themes/WebArch/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>\r\n<script src="/themes/WebArch/assets/plugins/pace/pace.min.js"></script>\r\n<script src="/themes/WebArch/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js"></script>\r\n<script src="/themes/WebArch/assets/js/core.js"></script>\r\n<script src="/themes/WebArch/assets/js/chat.js"></script>', '<link href="/themes/WebArch/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet">\r\n<link href="/themes/WebArch/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet">\r\n<link href="/themes/WebArch/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet">\r\n<link href="/themes/WebArch/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">\r\n<link href="/themes/WebArch/assets/css/animate.min.css" rel="stylesheet">\r\n<link href="/themes/WebArch/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet">\r\n<link href="/themes/WebArch/assets/css/style.css" rel="stylesheet">\r\n<link href="/themes/WebArch/assets/css/responsive.css" rel="stylesheet">\r\n<link href="/themes/WebArch/assets/css/custom-icon-set.css" rel="stylesheet">', '', '', '[{"type":"parameters/image_upload","name":"orgimg","label":"Organisation Image"}]', 5, 'Default', '\n		/files/2155unnamed.jpg\n'),
(5, '<body class="fixed-topbar fixed-sidebar theme-sdtl color-default">\n    <!--[if lt IE 7]>\n    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>\n    <![endif]-->\n    <section><!-- BEGIN SIDEBAR --><div class="sidebar">\n        <div class="logopanel">\n          <h1>\n            <a href="dashboard.html" style="background: url({{parm[''orgimg'']}}) no-repeat;"></a>\n          </h1>\n        </div>\n        <div class="sidebar-inner">\n          <div class="sidebar-top">\n            <form action="search-result.html" method="post" class="searchform" id="search-results">\n              <input type="text" class="form-control" name="keyword" placeholder="Search...">\n</form>\n            <div class="userlogged clearfix">\n              <i class="icon icons-faces-users-01"></i>\n              <div class="user-details">\n                <h4>{{username}}</h4>\n                <div class="dropdown user-login">\n                  <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">\n                  <i class="online"></i><span>Available</span><i class="fa fa-angle-down"></i>\n                  </button>\n                  <ul class="dropdown-menu">\n<li><a href="#"><i class="busy"></i><span>Busy</span></a></li>\n                    <li><a href="#"><i class="turquoise"></i><span>Invisible</span></a></li>\n                    <li><a href="#"><i class="away"></i><span>Away</span></a></li>\n                  </ul>\n</div>\n              </div>\n            </div>\n          </div>\n          <div class="menu-title">\n            Navigation \n            <div class="pull-right menu-settings">\n              <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300"> \n              <i class="icon-settings"></i>\n              </a>\n              <ul class="dropdown-menu">\n<li><a href="#" id="reorder-menu" class="reorder-menu">Reorder menu</a></li>\n                <li><a href="#" id="remove-menu" class="remove-menu">Remove elements</a></li>\n                <li><a href="#" id="hide-top-sidebar" class="hide-top-sidebar">Hide user &amp; search</a></li>\n              </ul>\n</div>\n          </div>\n          <ul class="nav nav-sidebar">\n\n{% for item in menu %}\n<li><a href="{{item[''link'']}}"><i class="fa {{item[''icon'']}}"></i><span>{{item[''title'']}}</span></a></li>\n{% endfor %}\n\n          </ul>\n<!-- SIDEBAR WIDGET FOLDERS --><div class="sidebar-widgets">\n            <p class="menu-title widget-title">Folders <span class="pull-right"><a href="#" class="new-folder"> <i class="icon-plus"></i></a></span></p>\n         \n</div>\n          <div class="sidebar-footer clearfix">\n            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">\n            <i class="icon-size-fullscreen"></i></a>\n            <a class="pull-left btn-effect" href="{{logout}}" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">\n            <i class="icon-power"></i></a>\n          </div>\n        </div>\n      </div>\n      <!-- END SIDEBAR -->\n      <div class="main-content">\n        <!-- BEGIN TOPBAR -->\n        <div class="topbar">\n          <div class="header-left">\n            <div class="topnav">\n              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>\n              <ul class="nav nav-icons">\n<li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>\n                <li><a href="mailbox.html"><span class="octicon octicon-mail-read"></span></a></li>\n                <li><a href="#"><span class="octicon octicon-flame"></span></a></li>\n                <li><a href="builder-page.html"><span class="octicon octicon-rocket"></span></a></li>\n              </ul>\n</div>\n          </div>\n          <div class="header-right">\n            <ul class="header-menu nav navbar-nav">\n              <!-- END USER DROPDOWN -->\n\n              <!-- BEGIN USER DROPDOWN -->\n              <li class="dropdown" id="user-header">\n                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">\n                <img src="{{userimage}}" alt="user image"><span class="username">Hi, {{username}}</span>\n                </a>\n                <ul class="dropdown-menu">\n                  <li>\n                    <a href="{{logout}}"><i class="icon-logout"></i><span>Logout</span></a>\n                  </li>\n                </ul>\n</li>\n            </ul>\n</div>\n          <!-- header-right -->\n        </div>\n        <!-- END TOPBAR -->\n        <!-- BEGIN PAGE CONTENT -->\n        <div class="page-content">\n          <div class="row">\n              {{region[0]}}\n          </div>\n                    <div class="row">\n              {{region[1]}}\n          </div>\n                    <div class="row">\n              {{region[2]}}\n          </div>\n                    <div class="row">\n              {{region[3]}}\n          </div>\n                    <div class="row">\n              {{region[4]}}\n          </div>\n                    <div class="row">\n              {{region[5]}}\n          </div>\n                    <div class="row">\n              {{region[6]}}\n          </div>\n                    <div class="row">\n              {{region[7]}}\n          </div>\n                    <div class="row">\n              {{region[8]}}\n          </div>\n                    <div class="row">\n              {{region[9]}}\n          </div>\n          \n          \n          <div class="footer">\n            <div class="copyright">\n              <p class="pull-left sm-pull-reset">\n                <span>Copyright <span class="copyright">©</span> 2015 </span>\n                <span>Prime Analytics</span>.\n                <span>All rights reserved. </span>\n              </p>\n              <p class="pull-right sm-pull-reset">\n                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>\n              </p>\n            </div>\n          </div>\n        </div>\n        <!-- END PAGE CONTENT -->\n      </div>\n      <!-- END MAIN CONTENT -->\n    </section>\n    <!-- BEGIN PRELOADER -->\n    <div class="loader-overlay">\n      <div class="spinner">\n        <div class="bounce1"></div>\n        <div class="bounce2"></div>\n        <div class="bounce3"></div>\n      </div>\n    </div>\n    <!-- END PRELOADER -->\n    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> \n    <!-- Jquery Cookies, for theme --><!-- simulate synchronous behavior when using AJAX --><!-- Modal with Validation --><!-- Custom Scrollbar sidebar --><!-- Show Dropdown on Mouseover --><!-- Charts Sparkline --><!-- Retina Display --><!-- Select Inputs --><!-- Checkbox & Radio Inputs --><!-- Background Image --><!-- Animated Progress Bar --><!-- Theme Builder --><!-- Sidebar on Hover --><!-- Notes Widget --><!-- Chat Script --><!-- Search Script --><!-- Main Plugin Initialization Script --><!-- Main Application Script --><!-- Main Application Script -->\n</body>', '<script src="/themes/Make/assets/global/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/jquery/jquery-1.11.1.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/gsap/main-gsap.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/jquery-cookies/jquery.cookies.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/jquery-block-ui/jquery.blockUI.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/bootbox/bootbox.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/charts-sparkline/sparkline.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/retina/retina.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/select2/select2.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/icheck/icheck.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/backstretch/backstretch.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>\r\n<script src="/themes/Make/assets/global/plugins/charts-chartjs/Chart.min.js"></script>\r\n<script src="/themes/Make/assets/global/js/builder.js"></script>\r\n<script src="/themes/Make/assets/global/js/sidebar_hover.js"></script>\r\n<script src="/themes/Make/assets/global/js/widgets/notes.js"></script>\r\n<script src="/themes/Make/assets/global/js/quickview.js"></script>\r\n<script src="/themes/Make/assets/global/js/pages/search.js"></script>\r\n<script src="/themes/Make/assets/global/js/plugins.js"></script>\r\n<script src="/themes/Make/assets/global/js/application.js"></script>\r\n<script src="/themes/Make/assets/admin/layout1/js/layout.js"></script>', '<link href="/themes/Make/assets/global/images/favicon.png" rel="stylesheet">\r\n<link href="/themes/Make/assets/global/css/style.css" rel="stylesheet">\r\n<link href="/themes/Make/assets/global/css/theme.css" rel="stylesheet">\r\n<link href="/themes/Make/assets/global/css/ui.css" rel="stylesheet">\r\n<link href="/themes/Make/assets/admin/layout1/css/layout.css" rel="stylesheet">', '', '', '[{"type":"parameters/image_upload","name":"orgimg","label":"Organisation Image"}]', 3, 'Default', '\r\n		/files/2156unnamed.jpg\r\n'),
(7, '<body class="boxed">\r\n<div id="wrapper">\r\n\r\n\r\n\r\n<!-- Header\r\n================================================== -->\r\n<div class="container">\r\n\r\n\r\n	<!-- Logo -->\r\n	<div class="four columns">\r\n		<div id="logo">\r\n			<h1><a href="index.html"><img src="{{parm[''orgimg'']}}" alt="Logo"></a></h1>\r\n		</div>\r\n	</div>\r\n\r\n\r\n\r\n\r\n</div>\r\n\r\n\r\n<!-- Navigation\r\n================================================== -->\r\n<div class="container">\r\n	<div class="sixteen columns">\r\n		\r\n		<a href="#menu" class="menu-trigger"><i class="fa fa-bars"></i> Menu</a>\r\n\r\n		<nav id="navigation"><ul class="menu" id="responsive">\r\n\r\n{% for item in menu %} \r\n<li class="demo-button">\r\n				  <a href="{{item[''link'']}}">{{item[''title'']}} </a>\r\n				</li>\r\n{% endfor %}\r\n\r\n			</ul></nav>\r\n</div>\r\n</div>\r\n\r\n<!-- Featured\r\n================================================== -->\r\n<div class="container">\r\n{{region[0]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n<div class="container">\r\n{{region[1]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n<div class="container">\r\n{{region[2]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n<div class="container">\r\n{{region[3]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n<div class="container">\r\n{{region[4]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n<div class="container">\r\n{{region[5]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n<div class="container">\r\n{{region[6]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n<div class="container">\r\n{{region[7]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n<div class="container">\r\n{{region[8]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n\r\n\r\n<!-- Footer\r\n================================================== -->\r\n<div id="footer">\r\n    \r\n<div class="container">\r\n{{region[9]}}\r\n</div>\r\n<div class="clearfix"></div>\r\n\r\n</div>\r\n<!-- Footer / End -->\r\n\r\n<!-- Footer Bottom / Start -->\r\n<div id="footer-bottom">\r\n\r\n	<!-- Container -->\r\n	<div class="container">\r\n\r\n		<div class="eight columns">© Copyright 2014 by <a href="#">Prime Analytics</a>. All Rights Reserved.</div>\r\n	</div>\r\n	<!-- Container / End -->\r\n\r\n</div>\r\n<!-- Footer Bottom / End -->\r\n\r\n<!-- Back To Top Button -->\r\n<div id="backtotop"><a href="#"></a></div>\r\n\r\n</div>\r\n\r\n\r\n<!-- Java Script\r\n================================================== -->\r\n<!-- Style Switcher\r\n================================================== --><div id="style-switcher">\r\n	<h2>Style Switcher <a href="#"></a>\r\n</h2>\r\n	\r\n	<div>\r\n<h3>Predefined Colors</h3>\r\n		<ul class="colors" id="color1">\r\n<li><a href="#" class="green" title="Green"></a></li>\r\n			<li><a href="#" class="blue" title="Blue"></a></li>\r\n			<li><a href="#" class="orange" title="Orange"></a></li>\r\n			<li><a href="#" class="navy" title="Navy"></a></li>\r\n			<li><a href="#" class="yellow" title="Yellow"></a></li>\r\n			<li><a href="#" class="peach" title="Peach"></a></li>\r\n			<li><a href="#" class="beige" title="Beige"></a></li>\r\n			<li><a href="#" class="purple" title="Purple"></a></li>\r\n			<li><a href="#" class="celadon" title="Celadon"></a></li>\r\n			<li><a href="#" class="pink" title="Pink"></a></li>\r\n			<li><a href="#" class="red" title="Red"></a></li>\r\n			<li><a href="#" class="brown" title="Brown"></a></li>\r\n			<li><a href="#" class="cherry" title="Cherry"></a></li>\r\n			<li><a href="#" class="cyan" title="Cyan"></a></li>\r\n			<li><a href="#" class="gray" title="Gray"></a></li>\r\n			<li><a href="#" class="darkcol" title="Dark"></a></li>\r\n		</ul>\r\n<h3>Layout Style</h3>\r\n		<div class="layout-style">\r\n			<select id="layout-style"><option value="1">Boxed</option>\r\n<option value="2">Wide</option></select>\r\n</div>\r\n	\r\n	<h3>Background Image</h3>\r\n		 <ul class="colors bg" id="bg">\r\n<li><a href="#" class="bg1"></a></li>\r\n			<li><a href="#" class="bg2"></a></li>\r\n			<li><a href="#" class="bg3"></a></li>\r\n			<li><a href="#" class="bg4"></a></li>\r\n			<li><a href="#" class="bg5"></a></li>\r\n			<li><a href="#" class="bg6"></a></li>\r\n			<li><a href="#" class="bg7"></a></li>\r\n			<li><a href="#" class="bg8"></a></li>\r\n			<li><a href="#" class="bg9"></a></li>\r\n			<li><a href="#" class="bg10"></a></li>\r\n			<li><a href="#" class="bg11"></a></li>\r\n			<li><a href="#" class="bg12"></a></li>\r\n			<li><a href="#" class="bg13"></a></li>\r\n			<li><a href="#" class="bg14"></a></li>\r\n			<li><a href="#" class="bg15"></a></li>\r\n			<li><a href="#" class="bg16"></a></li>\r\n		</ul>\r\n<h3>Background Color</h3>\r\n		<ul class="colors bgsolid" id="bgsolid">\r\n<li><a href="#" class="green-bg" title="Green"></a></li>\r\n			<li><a href="#" class="blue-bg" title="Blue"></a></li>\r\n			<li><a href="#" class="orange-bg" title="Orange"></a></li>\r\n			<li><a href="#" class="navy-bg" title="Navy"></a></li>\r\n			<li><a href="#" class="yellow-bg" title="Yellow"></a></li>\r\n			<li><a href="#" class="peach-bg" title="Peach"></a></li>\r\n			<li><a href="#" class="beige-bg" title="Beige"></a></li>\r\n			<li><a href="#" class="purple-bg" title="Purple"></a></li>\r\n			<li><a href="#" class="red-bg" title="Red"></a></li>\r\n			<li><a href="#" class="pink-bg" title="Pink"></a></li>\r\n			<li><a href="#" class="celadon-bg" title="Celadon"></a></li>\r\n			<li><a href="#" class="brown-bg" title="Brown"></a></li>\r\n			<li><a href="#" class="cherry-bg" title="Cherry"></a></li>\r\n			<li><a href="#" class="cyan-bg" title="Cyan"></a></li>\r\n			<li><a href="#" class="gray-bg" title="Gray"></a></li>\r\n			<li><a href="#" class="dark-bg" title="Dark"></a></li>\r\n		</ul>\r\n</div>\r\n	\r\n	<div id="reset"><a href="#" class="button color">Reset</a></div>\r\n		\r\n</div>\r\n\r\n\r\n</body>', '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>\r\n<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.jpanelmenu.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.themepunch.plugins.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.themepunch.revolution.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.themepunch.showbizpro.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.magnific-popup.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/hoverIntent.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/superfish.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.pureparallax.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.pricefilter.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.selectric.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.royalslider.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/SelectBox.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/modernizr.custom.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/waypoints.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.flexslider-min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.counterup.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.tooltips.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/jquery.isotope.min.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/puregrid.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/stacktable.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/custom.js"></script>\r\n<script src="/themes/Trizzy/assets/scripts/switcher.js"></script>', '<link href="/themes/Trizzy/assets/css/style.css" rel="stylesheet">\r\n<link href="/themes/Trizzy/assets/css/colors/green.css" rel="stylesheet">', '', '', '[{"type":"parameters/image_upload","name":"orgimg","label":"Organisation Image"}]', 8, 'Default', '\r\n		/files/2158Untitled.png\r\n'),
(8, '<body class="clearfix">\r\n<header class="clearfix"><form method="get" action="?">\r\n		<div class="met_bgcolor met_transition">\r\n			<button type="submit"><i class="fa fa-search"></i></button>\r\n			<input type="text" name="searchTerm" placeholder="Search Term...">\r\n</div>\r\n	</form>\r\n\r\n	<nav><ul class="met_clean_list">\r\n            {% for item in menu %} \r\n            <li><a href="{{item[''link'']}}" class="met_color_transition">{{item[''title'']}}</a></li>  \r\n            {% endfor %}\r\n		</ul></nav><ul class="met_clean_list met_header_socials">\r\n<li><a href="{{logout}}" class="met_color_transition"><i class="fa fa-sign-out"></i></a></li>\r\n    </ul></header><aside class="met_left_bar"><a href="#" class="met_logo"><img src="{{parm[''orgimg'']}}" alt="" height="108px"></a>\r\n    <div class="row">\r\n        {{region[0]}}\r\n    </div>\r\n<div class="row">\r\n    {{region[1]}}\r\n</div>\r\n</aside><section class="met_content_wrapper clearfix"><div class="met_content_loading"><figure class="met_ajax_loading"></figure></div>\r\n\r\n	<!-- Right Side Bar -->\r\n	<div class="met_rightSide">\r\n		<div class="met_rightSide_inner">\r\n			<div class="met_sidebar_block">\r\n                {{region[2]}}\r\n			</div>\r\n<!-- Popular Posts ENDS -->\r\n            <div class="met_sidebar_block">\r\n                {{region[3]}}\r\n            </div>\r\n<!-- Popular Posts ENDS -->\r\n		</div>\r\n	</div>\r\n<!-- Right Side Bar ENDS -->\r\n\r\n	<!-- Center Content -->\r\n	<div class="met_content">\r\n		<div class="met_content_inner">\r\n			<div class="row">\r\n                {{region[4]}}\r\n			</div>\r\n            <div class="row">\r\n                {{region[5]}}\r\n            </div>\r\n            <div class="row">\r\n                {{region[6]}}\r\n            </div>\r\n            <div class="row">\r\n                {{region[7]}}\r\n            </div>\r\n            <div class="row">\r\n                {{region[8]}}\r\n            </div>\r\n            <div class="row">\r\n                {{region[9]}}\r\n            </div>\r\n		</div>\r\n	</div>\r\n<!-- Center Content ENDS -->\r\n</section><!-- Scripts --><!--[if lte IE 8]><script src="js/respond.min.js"></script><![endif]-->\r\n</body>', '<script src="/themes/Santone/assets/js/modernizr.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery-1.11.2.min.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery.easing.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery.mCustomScrollbar.min.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery.mousewheel.min.js"></script>\r\n<script src="/themes/Santone/assets/js/bootstrap.min.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery.mCustomScrollbar.min.js"></script>\r\n<script src="/themes/Santone/assets/js/retina.js"></script>\r\n<script src="/themes/Santone/assets/js/superfish.js"></script>\r\n<script src="/themes/Santone/assets/js/hoverIntent.js"></script>\r\n<script src="/themes/Santone/assets/js/flickrfeed.min.js"></script>\r\n<script src="/themes/Santone/assets/js/caroufredsel.js"></script>\r\n<script src="/themes/Santone/assets/js/imagesLoaded.js"></script>\r\n<script src="/themes/Santone/assets/js/masonry.js"></script>\r\n<script src="/themes/Santone/assets/js/isotope.js"></script>\r\n<script src="http://maps.google.com/maps/api/js?sensor=true"></script>\r\n<script src="/themes/Santone/assets/js/gmaps.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery.debounceresize.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery.hcsticky.min.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery.tubeplayer.js"></script>\r\n<script src="/themes/Santone/assets/js/magnific-popup.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery.mixitup.min.js"></script>\r\n<script src="/themes/Santone/assets/js/responsiveCarousel.min.js"></script>\r\n<script src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>\r\n<script src="/themes/Santone/assets/js/jquery.nouislider.min.js"></script>\r\n<script src="/themes/Santone/assets/js/metcreative.html5audio.js"></script>\r\n<script src="/themes/Santone/assets/js/scripts.js"></script>\r\n\r\n<script src="http://code.highcharts.com/highcharts.js"></script>\r\n<script src="/themes/Pages/assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>\r\n  <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>\r\n    <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>\r\n    <script src="/themes/Pages/assets/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>\r\n    <script type="text/javascript" src="/themes/Pages/assets/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>\r\n    <script type="text/javascript" src="/themes/Pages/assets/assets/plugins/datatables-responsive/js/lodash.min.js"></script>\r\n    \r\n    <script type="text/javascript" src="/assets/plugins/listboxjs/listbox.js"></script>\r\n    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>', '<link href="/themes/Santone/assets/img/fav.png" rel="stylesheet">\r\n<link href="http://fonts.googleapis.com/css?family=Open Sans:300,400,600"></link>\r\n<link href="http://fonts.googleapis.com/css?family=Archivo Narrow"></link>\r\n<link href="/themes/Santone/assets/css/bootstrap.min.css" rel="stylesheet">\r\n<link href="/themes/Santone/assets/css/font-awesome.min.css" rel="stylesheet">\r\n<link href="/themes/Santone/assets/css/metcreative.audio/nouislider.fox.css" rel="stylesheet">\r\n<link href="/themes/Santone/assets/css/metcreative.audio/nouislider.space.css" rel="stylesheet">\r\n<link href="/themes/Santone/assets/css/metcreative.audio/style.css" rel="stylesheet">\r\n<link href="/themes/Santone/assets/css/superfish.css" rel="stylesheet">\r\n<link href="/themes/Santone/assets/css/magnific-popup.css" rel="stylesheet">\r\n<link href="/themes/Santone/assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">\r\n<link href="/themes/Santone/assets/css/style.css" rel="stylesheet">\r\n<link href="/themes/Santone/assets/css/responsive.css" rel="stylesheet">\r\n<link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">\r\n<link href="/assets/plugins/listboxjs/listbox.css" rel="stylesheet">\r\n<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/f3e99a6c02/integration/bootstrap/3/dataTables.bootstrap.css">\r\n', '', '', '[{"type":"parameters/image_upload","name":"orgimg","label":"Organisation Image"}]', 9, 'Default', '\r\n		/files/2159Untitled.png\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `theme_layout`
--

CREATE TABLE IF NOT EXISTS `theme_layout` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme_layout`
--

INSERT INTO `theme_layout` (`id`, `name`) VALUES
(2, 'Pages'),
(3, 'Make'),
(5, 'WebArch'),
(8, 'Trizzy'),
(9, 'Santone');

-- --------------------------------------------------------

--
-- Table structure for table `theme_login`
--

CREATE TABLE IF NOT EXISTS `theme_login` (
  `id` int(10) unsigned NOT NULL,
  `html` longtext,
  `js` longtext,
  `css` longtext,
  `script` longtext,
  `style` longtext,
  `form` longtext,
  `theme_layout_id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme_login`
--

INSERT INTO `theme_login` (`id`, `html`, `js`, `css`, `script`, `style`, `form`, `theme_layout_id`, `name`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `theme_portlet`
--

CREATE TABLE IF NOT EXISTS `theme_portlet` (
  `id` int(10) unsigned NOT NULL,
  `html` longtext,
  `js` longtext,
  `css` longtext,
  `script` longtext,
  `style` longtext,
  `form` longtext,
  `theme_layout_id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme_portlet`
--

INSERT INTO `theme_portlet` (`id`, `html`, `js`, `css`, `script`, `style`, `form`, `theme_layout_id`, `name`) VALUES
(3, '                <div class=" sm-no-padding">\n                  <div class="panel panel-transparent" style="background-color:{{parm[''color'']}}">\n                    <div class="panel-body no-padding">\n                      <div id="portlet-advance" class="panel panel-default">\n                        <div class="panel-heading ">\n                          <div class="panel-title">{{parm[''title'']}}\n                          </div>\n                          <div class="panel-controls">\n                            <ul>\n                              <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a>\n                              </li>\n                              <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a>\n                              </li>\n                              <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a>\n                              </li>\n                            </ul>\n                          </div>\n                        </div>\n                        <div class="panel-body">\n                            <div class="row">\n                            {{region[0]}}\n                            </div>\n                            <div class="row">\n                            {{region[1]}}\n                            </div>\n                            <div class="row">\n                            {{region[2]}}\n                            </div>\n\n                          </div>\n                        </div>\n                      </div>\n                    </div>\n                  </div>\n            ', '', '', '', '', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/color_picker","name":"color","label":"Panel  Color"}]', 2, 'Basic Portlet'),
(4, '\n                    \n                    \n                  <div class=" sm-no-padding">\n                  <div class="panel panel-transparent" style="background-color:{{parm[''color'']}}">\n                    <div class="panel-body no-padding">\n                      <div id="portlet-advance" class="panel panel-default">\n                        <div class="panel-heading separator">\n                          <div class="panel-title">{{parm[''title'']}}\n                          </div>\n                          <div class="panel-controls">\n                            <ul>\n                              <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a>\n                              </li>\n                              <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a>\n                              </li>\n                              <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a>\n                              </li>\n                            </ul>\n                          </div>\n                        </div>\n                        <div class="panel-body">\n                            <div class="row">\n                            {{region[0]}}\n                            </div>\n                            <div class="row">\n                            {{region[1]}}\n                            </div>\n                            <div class="row">\n                            {{region[2]}}\n                            </div>\n\n                          </div>\n                        </div>\n                      </div>\n                    </div>\n                  </div>\n            ', '', '', '', '', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/color_picker","name":"color","label":"Panel Color"}]', 2, 'Separator Portlet'),
(5, '             <div >\n              <!-- START PANEL -->\n              <div class="panel panel">\n                <div class="panel-heading ">\n                  <div class="panel-title">{{parm[''title'']}}\n                  </div>\n                  <div class="panel-controls">\n                    <ul>\n                      <li><a  class="portlet-collapse" data-toggle="collapse"><i class="pg-arrow_maximize"></i></a>\n                      </li>\n                      <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="pg-refresh_new"></i></a>\n                      </li>\n                      <li><a href="#" class="portlet-close" data-toggle="close"><i class="pg-close"></i></a>\n                      </li>\n                    </ul>\n                  </div>\n                </div>\n                <div class="panel-body">\n                    \n                    <?php $tabs = explode('','', $parm[''tabs'']) ?>\n\n                    <!-- Nav tabs -->\n                    <ul class="nav nav-tabs nav-tabs-linetriangle">\n                        {% for key,tab in tabs %}\n                        <li class="{% if key == 0 %}active{% endif  %}">\n                        <a onclick="tabchange()" data-toggle="tab" href="#tab-<?php echo str_replace (" ","_",$key) ?>"><span>{{ tab }}</span></a>\n                        </li>\n                        {% endfor %}\n                    </ul>\n                    <!-- Tab panes -->\n                    \n                    <div class="tab-content no-padding">\n                        \n                         {% for key,tab in tabs %}\n                        <div class="tab-pane {% if key == 0 %}active{% endif  %}" id="tab-<?php echo str_replace (" ","_",$key) ?>">\n                       {{region[key]}}\n                      </div>\n                        {% endfor %}\n                    </div>\n   \n                </div>\n              </div>\n              <!-- END PANEL -->', '', '', '', ' <style type="text/css">\r\n.tab-content > .tab-pane,\r\n.pill-content > .pill-pane {\r\n    display: block;     /* undo display:none          */\r\n    height: 0;          /* height:0 is also invisible */ \r\n    overflow-y: hidden; /* no-overflow                */\r\n}\r\n.tab-content > .active,\r\n.pill-content > .active {\r\n    height: auto;       /* let the content decide it  */\r\n}   \r\n </style>', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/input","name":"tabs","label":"Tabs (seperated by comma)"}]', 2, 'Tabbed Portlet'),
(6, '             <div >\n              <!-- START PANEL -->\n              <div class="panel panel">\n                <div class="panel-heading ">\n                  <div class="panel-title">{{parm[''title'']}}\n                  </div>\n                  <div class="panel-controls">\n                    <ul>\n                      <li><a  class="portlet-collapse" data-toggle="collapse"><i class="pg-arrow_maximize"></i></a>\n                      </li>\n                      <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="pg-refresh_new"></i></a>\n                      </li>\n                      <li><a href="#" class="portlet-close" data-toggle="close"><i class="pg-close"></i></a>\n                      </li>\n                    </ul>\n                  </div>\n                </div>\n                <div class="panel-body">\n                    \n                    <?php $tabs = explode('','', $parm[''tabs'']) ?>\n\n                    <!-- Nav tabs -->\n                    <ul class="nav nav-tabs nav-tabs-fillup">\n                        {% for key,tab in tabs %}\n                        <li class="{% if key == 0 %}active{% endif  %}">\n                        <a onclick="tabchange()" data-toggle="tab" href="#tab-<?php echo str_replace (" ","_",$key) ?>"><span>{{ tab }}</span></a>\n                        </li>\n                        {% endfor %}\n                    </ul>\n                    <!-- Tab panes -->\n                    \n                    <div class="tab-content no-padding">\n                        \n                         {% for key,tab in tabs %}\n                        <div class="tab-pane {% if key == 0 %}active{% endif  %}" id="tab-<?php echo str_replace (" ","_",$key) ?>">\n                       {{region[key]}}\n                      </div>\n                        {% endfor %}\n                    </div>\n   \n                </div>\n              </div>\n              <!-- END PANEL -->', '', '', '', ' <style type="text/css">\r\n.ui-tabs .ui-tabs-hide {\r\n     position: absolute;\r\n     top: -10000px;\r\n     display: block !important;\r\n}           \r\n </style>', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/input","name":"tabs","label":"Tabs (seperated by comma)"}]', 2, 'Tabbed Portlet Filled'),
(7, '                <div class=" sm-no-padding" >\n                  <div class="panel panel-transparent" >\n                    <div class="panel-body no-padding" >\n                      <div id="portlet-advance" class="panel panel-default" style="background-color:{{parm[''color'']}}">\n                        <div class="panel-heading ">\n                          <div class="panel-title">{{parm[''title'']}}\n                          </div>\n                          <div class="panel-controls">\n                            <ul>\n                              <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a>\n                              </li>\n                              <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a>\n                              </li>\n                              <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a>\n                              </li>\n                            </ul>\n                          </div>\n                        </div>\n                        <div class="panel-body">\n                            <div class="row">\n                            {{region[0]}}\n                            </div>\n                            <div class="row">\n                            {{region[1]}}\n                            </div>\n                            <div class="row">\n                            {{region[2]}}\n                            </div>\n\n                          </div>\n                        </div>\n                      </div>\n                    </div>\n                  </div>\n            ', '', '', '', '', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/color_picker","name":"color","label":"Panel  Color"}]', 2, 'Color Portlet'),
(8, '                 <div>\n							<div class="met_title">\n								<h2>{{parm[''title'']}}</h2>\n							</div>\n\n							<div class="met_skills">\n                            <div class="row">\n                            {{region[0]}}\n                            </div>\n                            <div class="row">\n                            {{region[1]}}\n                            </div>\n                            <div class="row">\n                            {{region[2]}}\n                            </div>\n							</div>\n						</div>\n            ', '', '', '', '', '[{"type":"parameters/input","name":"title","label":"Title"}]', 9, 'Clean'),
(9, '             <article class=" isotope-item">\n                 \n                 <a class="met_bl_preview">\n                     						<div class="row">\n						    {{region[0]}}\n						</div>\n						<div class="row">\n						</div>\n                     </a>\n\n					\n						\n							<div class="met_bl_item_details">\n							\n								<div class="met_blid_title_misc">\n									<a><h3 class="met_color_transition">{{parm[''title'']}}</h3></a>\n									<br>\n									<div class="met_blidtm_bottom_border"></div>\n								</div>\n\n								<div class="met_blid_excerpt"><p>{{parm[''description'']}}</p></div>\n\n							</div>\n						</article>', '', '', '', '', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/input","name":"description","label":"Description"}]', 9, 'Article'),
(10, '             <div >\n                    <?php $tabs = explode('','', $parm[''tabs'']) ?>\n\n                    <!-- Nav tabs -->\n                    <ul class="nav nav-tabs">\n                        {% for key,tab in tabs %}\n                        <li class="{% if key == 0 %}active{% endif  %}">\n                        <a onclick="tabchange()" data-toggle="tab" href="#tab-<?php echo str_replace (" ","_",$key) ?>"><span>{{ tab }}</span></a>\n                        </li>\n                        {% endfor %}\n                    </ul>\n                    <!-- Tab panes -->\n                    \n                    <div class="tab-content no-padding">\n                        \n                         {% for key,tab in tabs %}\n                        <div class="tab-pane fade {% if key == 0 %}in active{% endif  %}" id="tab-<?php echo str_replace (" ","_",$key) ?>">\n                       {{region[key]}}\n                      </div>\n                        {% endfor %}\n                    </div>\n   \n                </div>\n\n  ', '', '', '', ' <style type="text/css">\r\n.tab-content > .tab-pane,\r\n.pill-content > .pill-pane {\r\n    display: block;     /* undo display:none          */\r\n    height: 0;          /* height:0 is also invisible */ \r\n    overflow-y: hidden; /* no-overflow                */\r\n}\r\n.tab-content > .active,\r\n.pill-content > .active {\r\n    height: auto;       /* let the content decide it  */\r\n}   \r\n </style>', '[{"type":"parameters/input","name":"tabs","label":"Tabs (seperated by comma)"}]', 9, 'Tabbed Portlet'),
(11, '\n                    \n\n\n  <div >\n      <?php $tabs = explode('','', $parm[''tabs'']) ?>\n					<div class="met_accordions">\n					 {% for key,tab in tabs %}\n					 \n					 <div class="met_accordion">\n							<div class="met_accordion_head clearfix">\n								<span class="met_accordion_icon met_bgcolor_transition"><i class="plus">&#43;</i></span>\n								<span class="met_accordion_title">{{ tab }}</span>\n							</div>\n							<div class="met_accordion_content">\n								{{region[key]}}\n							</div>\n						</div>\n\n                    {% endfor %}\n					</div>\n				</div>\n				\n', '', '', '  <script>\r\n$(function(){\r\n		$(''.met_accordion.met_accordion_on .met_accordion_content'').slideDown();\r\n		$(''.met_accordion.met_accordion_on'').find(''.plus'').removeClass(''plus'').addClass(''minus'').html(''-'');\r\n\r\n		$(''.met_accordion_head'').click(function(){\r\n			var thisAccordion         = $(this);\r\n			var thisAccordionParent   = thisAccordion.parent();\r\n			var accordionContainer   = thisAccordionParent.parent();\r\n\r\n			if(thisAccordionParent.hasClass(''met_accordion_on'')){\r\n				thisAccordionParent.removeClass(''met_accordion_on'');\r\n				thisAccordion.next().slideUp();\r\n				thisAccordion.find(''.minus'').removeClass(''minus'').addClass(''plus'').html(''+'');\r\n			}else{\r\n				accordionContainer.find(''.met_accordion_on'').removeClass(''met_accordion_on'').children(''.met_accordion_content'').slideUp().parent().find(''.minus'').removeClass(''minus'').addClass(''plus'').html(''+'');\r\n				thisAccordionParent.addClass(''met_accordion_on'').children(''.met_accordion_content'').slideDown().parent().find(''.plus'').removeClass(''plus'').addClass(''minus'').html(''-'');\r\n			}\r\n		});\r\n	});\r\n  </script>', ' <style type="text/css">\r\n.met_accordion > .met_accordion_content {\r\n    display: block!important;    /* undo display:none          */\r\n    height: 0;          /* height:0 is also invisible */ \r\n    overflow-y: hidden; /* no-overflow                */\r\n}\r\n.met_accordion_on > .met_accordion_content{\r\n    height: auto;       /* let the content decide it  */\r\n}   \r\n </style>', '[{"type":"parameters/input","name":"tabs","label":"Tabs (seperated by comma)"}]', 9, 'Grouped List');

-- --------------------------------------------------------

--
-- Table structure for table `theme_widget`
--

CREATE TABLE IF NOT EXISTS `theme_widget` (
  `id` int(10) unsigned NOT NULL,
  `html` longtext,
  `js` longtext,
  `css` longtext,
  `script` longtext,
  `style` longtext,
  `form` longtext,
  `theme_layout_id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  `data_format` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme_widget`
--

INSERT INTO `theme_widget` (`id`, `html`, `js`, `css`, `script`, `style`, `form`, `theme_layout_id`, `name`, `category`, `data_format`) VALUES
(3, '<div>\r\n<h3>\r\n  {{parm[''title'']}}\r\n</h3>\r\n\r\n<select id="w_{{widget.id}}" class="input form-control">\r\n     {% for entry in parm[''db''] %}\r\n      <option value="{{entry[''link_column'']}}">{{entry[''values'']}}</option>\r\n    {% endfor  %}\r\n      \r\n</select>\r\n</div>', '', '', '<script>\r\n\r\n        $("#w_{{widget.id}}").change(function() {\r\n\r\n            update_dashboard("{{parm[''target_link'']}}", this.value);\r\n  \r\n        });\r\n\r\n        $("#w_{{widget.id}}" ).change();\r\n\r\n</script>', '', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"values","label":"Values"},{"type":"database/link_select"}]', 2, 'Select', 'Misc', 'ByRow'),
(5, '\n<div id="w_{{widget.id}}" style="width:100% min-width: 600px; height: 450px; margin: 0 auto"></div>\n', '', '', '<script>\r\n\r\n\r\n    function selectPointsByDrag(e) {\r\n\r\n        // Select points\r\n        Highcharts.each(this.series, function (series) {\r\n            Highcharts.each(series.points, function (point) {\r\n                if (point.x >= e.xAxis[0].min && point.x <= e.xAxis[0].max &&\r\n                        point.y >= e.yAxis[0].min && point.y <= e.yAxis[0].max) {\r\n                    point.select(true, true);\r\n                }\r\n            });\r\n        });\r\n\r\n        // Fire a custom event\r\n        HighchartsAdapter.fireEvent(this, ''selectedpoints'', { points: this.getSelectedPoints() });\r\n\r\n        return false; // Don''t zoom\r\n    }\r\n\r\n    /**\r\n     * The handler for a custom event, fired from selection event\r\n     */\r\n    function selectedPoints(e) {\r\n        var temp=[];\r\n                        $.each(e.points, function (i, value) {\r\n                            \r\n                {% if parm[''xtype''] == "Date" %}\r\n                temp.push(value.x);\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n                 temp.push(value.name);\r\n                {% else %}\r\n                 temp.push(value.x);\r\n                {% endif  %}\r\n                            \r\n                            \r\n                            \r\n                            \r\n                           \r\n                        });\r\n                            update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n\r\n    }\r\n\r\n    /**\r\n     * On click, unselect all points\r\n     */\r\n    function unselectByClick() {\r\n        var points = this.getSelectedPoints();\r\n        if (points.length > 0) {\r\n            Highcharts.each(points, function (point) {\r\n                point.select(false);\r\n            });\r\n        }\r\n    }\r\n\r\n\r\n\r\n$(''#w_{{widget.id}}'').highcharts({\r\n            chart: {\r\n            type: ''{{parm[''chart_type'']}}'',\r\n            spacingBottom: 50,\r\n            spacingTop: 50,\r\n            spacingLeft: 50,\r\n            spacingRight: 50,\r\n            events: {\r\n                selection: selectPointsByDrag,\r\n                selectedpoints: selectedPoints,\r\n                click: unselectByClick\r\n            },\r\n			zoomType: ''xy''\r\n        },\r\n        plotOptions: {\r\n            series: {\r\n                allowPointSelect: true\r\n            }\r\n        },\r\n title: {\r\n            text: ''{{parm[''chart_title'']}}''\r\n        },\r\n        		  credits: {\r\n  enabled: false\r\n  },\r\n        xAxis: {\r\n            title: {\r\n                text: ''''\r\n            },\r\n            \r\n                {% if parm[''xtype''] == "Date" %}\r\n                type: ''datetime'',\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n                type: ''category'',\r\n                {% else %}\r\n                {% endif  %}\r\n            \r\n        },\r\n        yAxis: {\r\n            title: {\r\n                text: ''value''\r\n            }\r\n        },\r\n        colors:{{parm[''colors'']}},\r\n series: [\r\n{% for key,series in parm[''db''] %}\r\n{\r\n     name: ''{{key|escape_js}}'',\r\n     data: [\r\n        {% for row in series %}\r\n        \r\n                {% if parm[''xtype''] == "Date" %}\r\n    [Date.parse(''{{ row[''x_axis'']|escape_js }}''),{{ row[''value'']|escape_js }}] ,\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n    [''{{ row[''x_axis'']|escape_js }}'',{{ row[''value'']|escape_js }}] ,\r\n                {% else %}\r\n    [{{ row[''x_axis'']|escape_js }},{{ row[''value'']|escape_js }}] ,\r\n                {% endif  %}\r\n        {% endfor  %}\r\n]},\r\n\r\n{% endfor  %}\r\n]\r\n\r\n});\r\n\r\n$(''#preview_{{widget.id}}'').on(''click'', function(){\r\n    \r\n            var chart = $(''#w_{{widget.id}}'').highcharts(),\r\n            selectedPoints = chart.getSelectedPoints();\r\n\r\n                            var temp=[];\r\n                        $.each(selectedPoints, function (i, value) {\r\n                            temp.push(value.x);\r\n                        });\r\n                            update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n    \r\n});\r\n\r\n\r\n</script>', '', '[{"type":"database/chart"},{"type":"parameters/select","name":"chart_type","label":"Chart  Type","values":"area,bar,areaspline,column,scatter,spline"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"database/link_select"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"}]', 2, 'Line Chart', 'Charts', 'Chart'),
(6, '\n<table id="w_{{widget.id}}" class="table table-hover table-condensed">\n                        <thead>\n                          <tr>\n                              {% if (parm[''db'']|length !=0) %}\n                              \n                    {% for key,item in parm[''db''][0][''series''] %}\n                    <th>{{key}} </th>\n                    {% endfor  %}\n                    {% endif %}\n                          </tr>\n                        </thead>\n                        <tbody>\n                          \n                             {% for row in parm[''db''] %}\n                             <tr>\n        {% for item in row[''series''] %}\n<td class="v-align-middle">{{item}} </td>\n        {% endfor  %}\n</tr>\n{% endfor  %}\n                        </tbody>\n                      </table>\n                      ', '', '', '   <script>\n   var initTableWithSearch = function() {\n        var table = $(''#w_{{widget.id}}'');\n        \n <?php $linking_column=array(); ?>     \n {% for row in parm[''db''] %}\n  <?php $linking_column[]=$row[''link_column'']; ?> \n{% endfor  %}\nvar linking_column=<?php echo json_encode($linking_column) ?> ;\n\n        var settings = {\n            "sDom": ''T<"clear">lfrtip'',\n            "sPaginationType": "bootstrap",\n            "destroy": true,\n            "bLengthChange": false,\n            "bFilter": false,\n            "bInfo": false,\n            "scrollX": true,\n            "scrollCollapse": true,\n            "paging":         true,\n                    "oTableTools": {\n            "sRowSelect": "multi",\n            "aButtons" : []\n        }\n        };\n        \n\n\n    table.dataTable(settings);\n        \n\n         $(''#w_{{widget.id}} tbody'').on( ''click'', ''tr'', function () {\n        $(this).toggleClass(''selected'');\n            var oTT = TableTools.fnGetInstance( ''w_{{widget.id}}'' );\n    var aData = oTT.fnGetSelectedIndexes();\n    var link_set=[];\n    $.each( aData, function( key, value ) {\n    link_set.push(linking_column[value]);\n    });\n    \n    \n    \n    \n     update_dashboard("{{parm[''target_link'']}}", link_set,{{widget.id}});\n        \n    } );\n   \n\n        // search box for table\n        $(''#search-table{{widget.id}}'').keyup(function() {\n            table.fnFilter($(this).val());\n        });\n    }\n    \n    initTableWithSearch();\n    \n    \n    \n    \n    </script>', '', '[{"type":"database/multi_select","name":"series","label":"Table Columns"},{"type":"database/link_select"}]', 2, 'Basic Table', 'Tables', 'ByRow'),
(7, '<div id="w_{{widget.id}}" style="width:100%;height:500px"><svg></svg></div>', '', '', '<script>\r\n\r\n\r\n\r\n\r\n\r\n\r\n(function() {\r\n    \r\n    var datain=[\r\n{% for key,series in parm[''db''] %}\r\n{\r\n     "key": ''{{key|escape_js}}'',\r\n     "values": [\r\n        {% for row in series %}\r\n    {x:''{{ row[''x_axis'']|escape_js }}'',y:{{ row[''value'']|escape_js }}} ,\r\n        {% endfor  %}\r\n]},\r\n\r\n{% endfor  %}\r\n];\r\n    \r\n                nv.addGraph(function() {\r\n                    var chart = nv.models.lineChart()\r\n                        .useInteractiveGuideline(true);\r\n\r\n                    d3.select(''#w_{{widget.id}} svg'')\r\n                        .datum(datain)\r\n                        .transition().duration(500)\r\n                        .call(chart);\r\n\r\n                    nv.utils.windowResize(chart.update);\r\n\r\n                    $(''#w_{{widget.id}}'').data(''chart'', chart);\r\n\r\n                    return chart;\r\n                });\r\n            })();\r\n\r\n\r\n\r\n\r\n</script>', '', '[{"type":"database/chart"}]', 2, 'Line Chart', 'nvd3', 'Chart'),
(8, '<div id="w_{{widget.id}}" style="width:100%;height:500px"><svg></svg></div>', '', '', '<script>\r\n(function() {\r\n    \r\n    var datain=[\r\n{% for key,series in parm[''db''] %}\r\n{\r\n     "key": ''{{key|escape_js}}'',\r\n     "values": [\r\n        {% for row in series %}\r\n    {x:''{{ row[''x_axis'']|escape_js }}'',y:{{ row[''value'']|escape_js }}} ,\r\n        {% endfor  %}\r\n]},\r\n\r\n{% endfor  %}\r\n];\r\n    \r\n                nv.addGraph(function() {\r\n                    var chart = nv.models.scatterChart()\r\n\r\n                    d3.select(''#w_{{widget.id}} svg'')\r\n                        .datum(datain)\r\n                        .transition().duration(500)\r\n                        .call(chart);\r\n\r\n                                        nv.utils.windowResize(function() {\r\n\r\n                        chart.update();\r\n\r\n                        var xTicks = d3.select(''.nv-y.nv-axis  g'').selectAll(''g'');\r\n                        xTicks\r\n                            .selectAll(''text'')\r\n                            .attr(''transform'', function(d, i, j) {\r\n                                return ''translate (10, 0)''\r\n                            });\r\n\r\n                        var yTicks = d3.select(''.nv-x.nv-axis  g'').selectAll(''g'');\r\n                        yTicks\r\n                            .selectAll(''text'')\r\n                            .attr(''transform'', function(d, i, j) {\r\n                                return ''translate (0, 10)''\r\n                            });\r\n\r\n                        var minmax = d3.select(''.nv-x.nv-axis g'');\r\n                        minmax\r\n                            .selectAll(''text'')\r\n                            .attr(''transform'', function(d, i, j) {\r\n                                return ''translate (0, 10)''\r\n                            });\r\n\r\n\r\n                        var legend = d3.select(''.nv-legendWrap .nv-legend'');\r\n                        legend.attr(''transform'', function(d, i, j) {\r\n                            return ''translate (0, -20)''\r\n                        });\r\n\r\n                    });\r\n\r\n                    $(''#w_{{widget.id}}'').data(''chart'', chart);\r\n\r\n                    return chart;\r\n                });\r\n            })();\r\n\r\n\r\n</script>', '', '[{"type":"database/chart"}]', 2, 'Scatter Plot', 'nvd3', 'Chart'),
(9, '<div id="w_{{widget.id}}" style="width:100%;height:500px"><svg></svg></div>', '', '', '<script>\r\n(function() {\r\n    \r\n    var datain=[\r\n{% for key,series in parm[''db''] %}\r\n{\r\n     "key": ''{{key|escape_js}}'',\r\n     "values": [\r\n        {% for row in series %}\r\n    {x:''{{ row[''x_axis'']|escape_js }}'',y:{{ row[''value'']|escape_js }}} ,\r\n        {% endfor  %}\r\n]},\r\n\r\n{% endfor  %}\r\n];\r\n    \r\n                nv.addGraph(function() {\r\n                    var chart = nv.models.stackedAreaChart()\r\n                        .useInteractiveGuideline(true);\r\n\r\n                    d3.select(''#w_{{widget.id}} svg'')\r\n                        .datum(datain)\r\n                        .transition().duration(500)\r\n                        .call(chart);\r\n\r\n                    nv.utils.windowResize(chart.update);\r\n\r\n                    $(''#w_{{widget.id}}'').data(''chart'', chart);\r\n\r\n                    return chart;\r\n                });\r\n            })();\r\n\r\n\r\n\r\n\r\n</script>', '', '[{"type":"database/chart"}]', 2, 'Stacked Area Chart', 'nvd3', 'Chart'),
(10, '\n                    <h5>Date\n                                        <span class="semi-bold">Range</span>\n                                    </h5>\n                    <br>\n                    <div class="input-daterange input-group" id="datepicker-range">\n                      <input type="text" class="input-sm form-control" name="start" />\n                      <span class="input-group-addon">to</span>\n                      <input type="text" class="input-sm form-control" name="end" />\n                    </div>', '', '', '<script>\n$(''#datepicker-range'').datepicker();\n</script>', '', '[]', 2, 'Date Range', 'misc', 'ByRow'),
(11, '<div class=" m-b-10">\n                    <div class="ar-1-1">\n                         <div class="widget-3 panel no-border no-margin widget-loader-bar" style="background-color:{{parm[''tile_color'']}}">\n                        <div class="panel-body no-padding">\n                          <div class="metro live-tile" data-mode="carousel" data-start-now="true" data-delay="3000">\n\n                  {% for key, value in parm[''db''][''0''][''tiles''] %}\n                  \n                  <div class="slide-back tiles">\n                                <div class="padding-30">\n\n                                    <div class="pull-bottom p-b-30">\n                                        <h3 class="no-margin text-white p-b-10">\n                                            {{key|capitalize}}</h3></br>\n                                            <h3  class="no-margin text-white p-b-10"><span class="semi-bold">{{value}}</span></h3>\n                                        \n                                    </div>\n                                </div>\n                            </div>\n                  \n                  {% endfor %}\n                          </div>\n                        </div>\n                      </div>\n                      </div>\n                  </div>\n                  ', '', '', '<script>\n$(".widget-3 .metro").liveTile();\n</script>', '', '[{"type":"database/multi_select","name":"tiles","label":"Tiles Source"},{"type":"parameters/color_picker","name":"tile_color","label":"Tile Color"}]', 2, 'Live Tile', 'misc', 'ByRow'),
(12, '<div class="col-md-{{parm[''width'']}}">\r\n<select id="w_{{widget.id}}" style="width:100%" class="input" multiple="multiple" placeholder="{{parm[''title'']}}">\r\n     {% for entry in parm[''db''] %}\r\n      <option value="{{entry[''link_column'']}}">{{entry[''values'']}}</option>\r\n    {% endfor  %}\r\n</select>\r\n</div>', '', '', '<script>\r\n\r\n$("#w_{{widget.id}}").select2();\r\n\r\n        $("#w_{{widget.id}}").change(function() {\r\n        \r\n            update_dashboard("{{parm[''target_link'']}}", $("#w_{{widget.id}}").select2("val"),{{widget.id}});\r\n  \r\n        });\r\n\r\n\r\n\r\n</script>', '', '[{"type":"parameters/select","name":"width","label":"Width","values":"1,2,3,4,5,6,7,8,9,10,11,12"},{"type":"database/single_select","name":"values","label":"Values"},{"type":"database/link_select"},{"type":"parameters/input","name":"title","label":"Title"}]', 2, 'Multi Select', 'misc', 'ByRow'),
(13, '<div id="w_{{widget.id}}" style="width:100% min-width: 600px; height: 450px; margin: 0 auto"></div>', '', '', '<?php\r\n\r\n    $dataOut=array();\r\n    foreach($parm[''db''] as $row)\r\n    {\r\n        $dataOut[$row[''grouping'']][]=array("x_axis"=>$row[''x_axis''],"value"=>$row[''y_axis'']);\r\n    }\r\n\r\n?>\r\n\r\n<script>\r\n$(''#w_{{widget.id}}'').highcharts({\r\n            chart: {\r\n            type: ''{{parm[''chart_type'']}}'',\r\n            spacingBottom: 50,\r\n            spacingTop: 50,\r\n            spacingLeft: 50,\r\n            spacingRight: 50,\r\n			zoomType: ''xy''\r\n        },\r\n title: {\r\n            text: ''{{parm[''chart_title'']}}''\r\n        },\r\n        		  credits: {\r\n  enabled: false\r\n  },\r\n        xAxis: {\r\n            title: {\r\n                text: ''{{parm[''x_label'']}}''\r\n            },\r\n            \r\n                {% if parm[''xtype''] == "Date" %}\r\n                type: ''datetime'',\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n                type: ''datetime'',\r\n                {% else %}\r\n                {% endif  %}\r\n            \r\n        },\r\n        yAxis: {\r\n            title: {\r\n                text: ''{{parm[''y_label'']}}''\r\n            }\r\n        },\r\n        colors:{{parm[''colors'']}},\r\n series: [\r\n{% for key,series in dataOut %}\r\n{\r\n     name: ''{{key|escape_js}}'',\r\n     data: [\r\n        {% for row in series %}\r\n        \r\n                {% if parm[''xtype''] == "Date" %}\r\n    [Date.parse(''{{ row[''x_axis'']|escape_js }}''),{{ row[''value'']|escape_js }}] ,\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n    [''{{ row[''x_axis'']|escape_js }}'',{{ row[''value'']|escape_js }}] ,\r\n                {% else %}\r\n    [{{ row[''x_axis'']|escape_js }},{{ row[''value'']|escape_js }}] ,\r\n                {% endif  %}\r\n        {% endfor  %}\r\n]},\r\n\r\n{% endfor  %}\r\n] \r\n\r\n});\r\n</script>', '', '[{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"parameters/select","name":"xtype","label":"X Type","values":"Date,Category,Numeric"},{"type":"database/single_select","name":"x_axis","label":"X-Axis"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"parameters/input","name":"x_label","label":"X-Label"},{"type":"parameters/input","name":"y_label","label":"Y-Label"},{"type":"parameters/select","name":"chart_type","label":"Chart Type","values":"area,bar,areaspline,bar,column,scatter,spline"},{"type":"database/single_select","name":"grouping","label":"Grouping"},{"type":"database/single_select","name":"y_axis","label":"Y-Axis"}]', 2, 'Grouped Chart', 'misc', 'ByRow'),
(15, '<div class="m-b-10">\r\n                    <!-- START WIDGET -->\r\n                    <div class="widget-9 panel no-border bg-primary no-margin widget-loader-bar">\r\n                      <div class="container-xs-height full-height">\r\n                        <div class="row-xs-height">\r\n                          <div class="col-xs-height col-top">\r\n                            <div class="panel-heading  top-left top-right">\r\n                              <div class="panel-title text-black">\r\n                                <span class="font-montserrat fs-11 all-caps">{{parm[''title'']}} <i class="fa fa-chevron-right"></i>\r\n                                                    </span>\r\n                              </div>\r\n                              <div class="panel-controls">\r\n                                <ul>\r\n                                  <li><a href="#" class="portlet-refresh text-black" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a>\r\n                                  </li>\r\n                                </ul>\r\n                              </div>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                        <div class="row-xs-height">\r\n                          <div class="col-xs-height col-top">\r\n                            <div class="p-l-20 p-t-15">\r\n                              <h3 class="no-margin p-b-5 text-white">{{parm[''db''][''0''][''value'']}}</h3>\r\n                              <a href="#" class="btn-circle-arrow text-white"><i class="pg-arrow_minimize"></i>\r\n                                                        </a>\r\n                              <span class="small hint-text">{% if(parm[''db''][''0''][''max'']!=0) %}{{(parm[''db''][''0''][''value'']/parm[''db''][''0''][''max''])*100}}{% else %} 0 {% endif %}%</span>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                        <div class="row-xs-height">\r\n                          <div class="col-xs-height col-bottom">\r\n                            <div class="progress progress-small m-b-20">\r\n                              <!-- START BOOTSTRAP PROGRESS (http://getbootstrap.com/components/#progress) -->\r\n                              <div class="progress-bar progress-bar-white" style="width:{% if(parm[''db''][''0''][''max'']!=0) %}{{(parm[''db''][''0''][''value'']/parm[''db''][''0''][''max''])*100}}{% else %} 0 {% endif %}%"></div>\r\n                              <!-- END BOOTSTRAP PROGRESS -->\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                    <!-- END WIDGET -->\r\n                  </div>', '', '', '', '', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"database/single_select","name":"max","label":"Max"}]', 2, 'indicator', 'Misc', 'ByRow'),
(16, '<div class="m-b-10">\r\n                    <div class="ar-2-1">\r\n                      <!-- START WIDGET -->\r\n                      <div class="widget-4 panel no-border  no-margin widget-loader-bar">\r\n                        <div class="container-sm-height full-height">\r\n                          <div class="row-sm-height">\r\n                            <div class="col-sm-height col-top">\r\n                              <div class="panel-heading ">\r\n                                <div class="panel-title text-black hint-text">\r\n                                  <span class="font-montserrat fs-11 all-caps">{{parm[''title'']}}<i class="fa fa-chevron-right"></i>\r\n                                                        </span>\r\n                                </div>\r\n                                <div class="panel-controls">\r\n                                  <ul>\r\n                                    <li><a href="#" class="portlet-refresh text-black" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a>\r\n                                    </li>\r\n                                  </ul>\r\n                                </div>\r\n                              </div>\r\n                            </div>\r\n                          </div>\r\n                          <div class="row-sm-height">\r\n                            <div class="col-sm-height col-bottom ">\r\n                              <div id="w_{{widget.id}}" class="line-chart " data-line-color="success" data-area-color="success-light" data-y-grid="false" data-points="false" data-stroke-width="2">\r\n                                <svg></svg>\r\n                              </div>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                      <!-- END WIDGET -->\r\n                    </div>\r\n                  </div>', '', '', '            <script>\n            (function() {\n                \n                \n                var datain=[\n{\n     "values": [\n         {% for row in parm[''db''] %}\n    {x:Date.parse(''{{ row[''x_axis'']|escape_js }}''),y:{{ row[''y_axis'']|escape_js }}} ,\n        {% endfor  %}\n]}\n];\n                \n                \n                nv.addGraph(function() {\n                    var chart = nv.models.lineChart()\n                        .color([\n                            $.Pages.getColor(''success'')\n                        ])\n                        .useInteractiveGuideline(true)\n\n                    .margin({\n                            top: 60,\n                            right: -10,\n                            bottom: -10,\n                            left: -10\n                        })\n                        .showLegend(false);\n\n\n                    d3.select(''#w_{{widget.id}} svg'')\n                        .datum(datain)\n                        .transition().duration(500)\n                        .call(chart);\n\n\n                    nv.utils.windowResize(function() {\n\n                        chart.update();\n\n                    });\n\n                    $(''#w_{{widget.id}}'').data(''chart'', chart);\n\n                    return chart;\n                }, function() {\n\n                });\n            })();\n            </script>', '', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"x_axis","label":"X Axis"},{"type":"database/single_select","name":"y_axis","label":"Y Axis"}]', 2, 'Indicator Area Chart', 'Misc', 'ByRow'),
(17, '<div class="m-b-10">\r\n                    <div class="ar-2-1">\r\n                      <!-- START WIDGET -->\r\n                      <div class="widget-5 panel no-border  widget-loader-bar">\r\n                        <div class="panel-heading pull-top top-right">\r\n                          <div class="panel-controls">\r\n                            <ul>\r\n                              <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a>\r\n                              </li>\r\n                            </ul>\r\n                          </div>\r\n                        </div>\r\n                        <div class="container-xs-height full-height">\r\n                          <div class="row row-xs-height">\r\n                            <div class="col-xs-5 col-xs-height col-middle relative">\r\n                              <div class="padding-15 top-left bottom-left">\r\n                                <h5 class="hint-text no-margin p-l-10">Italy, Florence</h5>\r\n                                <p class=" bold font-montserrat p-l-10">2,345,789\r\n                                  <br>USD</p>\r\n                                <p class=" hint-text visible-xlg p-l-10">Today''s sales</p>\r\n                              </div>\r\n                            </div>\r\n                            <div class="col-md-7 col-xs-height col-bottom relative ">\r\n                              <div id="w_{{widget.id}}"></div>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                      <!-- END WIDGET -->\r\n                    </div>\r\n                  </div>', '', '', '<script>         \n          // widget 5\n            (function() {\n                var container = ''#w_{{widget.id}}'';\n\n                var datain=[\n\n         {% for row in parm[''db''] %}\n    {x:Date.parse(''{{ row[''x_axis'']|escape_js }}''),y:{{ row[''y_axis'']|escape_js }}} ,\n        {% endfor  %}\n];\n\n                var graph = new Rickshaw.Graph({\n                    element: document.querySelector(container),\n                    renderer: ''bar'',\n                    series: [{\n                        data:datain,\n                        color: $.Pages.getColor(''danger'')\n                    }]\n\n                });\n\n\n                var MonthBarsRenderer = Rickshaw.Class.create(Rickshaw.Graph.Renderer.Bar, {\n                    barWidth: function(series) {\n\n                        return 7;\n                    }\n                });\n\n\n                graph.setRenderer(MonthBarsRenderer);\n\n\n                graph.render();\n\n\n                $(window).resize(function() {\n                    graph.configure({\n                        width: $(container).width(),\n                        height: $(container).height()\n                    });\n\n                    graph.render()\n                });\n\n                $(container).data(''chart'', graph);\n\n            })();\n            \n            </script> ', '', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"x_axis","label":"X Axis"},{"type":"database/single_select","name":"y_axis","label":"Y Axis"}]', 2, 'Indicator Bar Chart', 'Misc', 'ByRow'),
(18, '<div class="col-md-12 m-b-10">\r\n                    <!-- START WIDGET -->\r\n                    <div class="widget-8 panel no-border bg-success no-margin widget-loader-bar">\r\n                      <div class="container-xs-height full-height">\r\n                        <div class="row-xs-height">\r\n                          <div class="col-xs-height col-top">\r\n                            <div class="panel-heading top-left top-right">\r\n                              <div class="panel-title text-black hint-text">\r\n                                <span class="font-montserrat fs-11 all-caps">Weekly Sales <i class="fa fa-chevron-right"></i>\r\n                                                    </span>\r\n                              </div>\r\n                              <div class="panel-controls">\r\n                                <ul>\r\n                                  <li>\r\n                                    <a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a>\r\n                                  </li>\r\n                                </ul>\r\n                              </div>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                        <div class="row-xs-height ">\r\n                          <div class="col-xs-height col-top relative">\r\n                            <div class="row">\r\n                              <div class="col-sm-6">\r\n                                <div class="p-l-20">\r\n                                  <h3 class="no-margin p-b-5 text-white">$14,000</h3>\r\n                                  <p class="small hint-text m-t-5">\r\n                                    <span class="label  font-montserrat m-r-5">60%</span>Higher\r\n                                  </p>\r\n                                </div>\r\n                              </div>\r\n                              <div class="col-sm-6">\r\n                              </div>\r\n                            </div>\r\n                            <div class=''widget-8-chart line-chart'' data-line-color="black" data-points="true" data-point-color="success" data-stroke-width="2">\r\n                              <svg></svg>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                    <!-- END WIDGET -->\r\n                  </div>', '', '', '', '', '[]', 2, 'Indicator Line Chart', 'Misc', 'ByRow'),
(19, ' <h3>{{parm[''title'']}}</h3>\n <div id="w_{{widget.id}}" style="width:100% margin: 0"></div>\n', '\n', '', '<script>\n\ndataIn=\nMorris.Donut({\n  element: ''w_{{widget.id}}'',\n  data:[\n  {% for row in parm[''db''] %}\n{\n     label: ''{{ row[''label'']|escape_js }}'',\n     value: {{ row[''value'']|escape_js }}\n},\n{% endfor  %}\n]}).on(''click'', function(i, row){\n\n     update_dashboard("{{parm[''target_link'']}}", row.label,{{widget.id}});\n});\n</script>', '  ', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"database/single_select","name":"label","label":"Label"},{"type":"database/link_select"}]', 2, 'Donut Chart', 'Morris', 'ByRow'),
(20, '<div>\r\n<h3>\r\n  {{parm[''title'']}}\r\n</h3>\r\n\r\n<select id="w_{{widget.id}}" class="input form-control">\r\n     {% for entry in parm[''db''] %}\r\n      <option value="{{entry[''link_column'']}}">{{entry[''values'']}}</option>\r\n    {% endfor  %}\r\n      \r\n</select>\r\n</div>', '', '', '<script>\r\n\r\n        $("#w_{{widget.id}}").change(function() {\r\n\r\n            update_dashboard("{{parm[''target_link'']}}", this.value);\r\n  \r\n        });\r\n\r\n        $("#w_{{widget.id}}" ).change();\r\n\r\n</script>', '', '[{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/single_select","name":"values","label":"Values"},{"type":"database/link_select"}]', 3, 'Select', 'Misc', 'ByRow'),
(22, '\n<table id="w_{{widget.id}}" class="table table-hover">\n                        <thead>\n                          <tr>\n                              {% if (parm[''db'']|length !=0) %}\n                              \n                    {% for key,item in parm[''db''][0][''series''] %}\n                    <th>{{key}} </th>\n                    {% endfor  %}\n                    {% endif %}\n                          </tr>\n                        </thead>\n                        <tbody>\n                          \n                             {% for row in parm[''db''] %}\n                             <tr>\n        {% for item in row[''series''] %}\n<td class="v-align-middle">{{item}} </td>\n        {% endfor  %}\n</tr>\n{% endfor  %}\n                        </tbody>\n                      </table>\n                      ', '', '', '   <script>\n   var initTableWithSearch = function() {\n        var table = $(''#w_{{widget.id}}'');\n        \n <?php $linking_column=array(); ?>     \n {% for row in parm[''db''] %}\n  <?php $linking_column[]=$row[''link_column'']; ?> \n{% endfor  %}\nvar linking_column=<?php echo json_encode($linking_column) ?> ;\n\n        var settings = {\n            "sDom": ''T<"clear">lfrtip'',\n            "destroy": true,\n            "bLengthChange": false,\n            "bFilter": false,\n            "bInfo": false,\n            "scrollX": true,\n            "responsive": true,\n            "scrollCollapse": true,\n            "paging":         true,\n                    "oTableTools": {\n            "sRowSelect": "multi",\n            "aButtons" : []\n        }\n        };\n        \n\n\n    table.dataTable(settings);\n        \n\n         $(''#w_{{widget.id}} tbody'').on( ''click'', ''tr'', function () {\n        $(this).toggleClass(''selected'');\n            var oTT = TableTools.fnGetInstance( ''w_{{widget.id}}'' );\n    var aData = oTT.fnGetSelectedIndexes();\n    var link_set=[];\n    $.each( aData, function( key, value ) {\n    link_set.push(linking_column[value]);\n    });\n    \n    \n    \n    \n     update_dashboard("{{parm[''target_link'']}}", link_set,{{widget.id}});\n        \n    } );\n   \n    }\n    \n    initTableWithSearch();\n    \n    \n    \n    \n    </script>', '', '[{"type":"database/multi_select","name":"series","label":"Table Columns"},{"type":"database/link_select"}]', 9, 'Basic Table', 'Tables', 'ByRow'),
(23, '\n<div id="w_{{widget.id}}" style="width:100% min-width: 600px; height: 450px; margin: 0 auto"></div>\n', '', '', '<script>\r\n\r\n\r\n    function selectPointsByDrag(e) {\r\n\r\n        // Select points\r\n        Highcharts.each(this.series, function (series) {\r\n            Highcharts.each(series.points, function (point) {\r\n                if (point.x >= e.xAxis[0].min && point.x <= e.xAxis[0].max &&\r\n                        point.y >= e.yAxis[0].min && point.y <= e.yAxis[0].max) {\r\n                    point.select(true, true);\r\n                }\r\n            });\r\n        });\r\n\r\n        // Fire a custom event\r\n        HighchartsAdapter.fireEvent(this, ''selectedpoints'', { points: this.getSelectedPoints() });\r\n\r\n        return false; // Don''t zoom\r\n    }\r\n\r\n    /**\r\n     * The handler for a custom event, fired from selection event\r\n     */\r\n    function selectedPoints(e) {\r\n        var temp=[];\r\n                        $.each(e.points, function (i, value) {\r\n                            \r\n                {% if parm[''xtype''] == "Date" %}\r\n                temp.push(value.x);\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n                 temp.push(value.name);\r\n                {% else %}\r\n                 temp.push(value.x);\r\n                {% endif  %}\r\n                            \r\n                            \r\n                            \r\n                            \r\n                           \r\n                        });\r\n                            update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n\r\n    }\r\n\r\n    /**\r\n     * On click, unselect all points\r\n     */\r\n    function unselectByClick() {\r\n        var points = this.getSelectedPoints();\r\n        if (points.length > 0) {\r\n            Highcharts.each(points, function (point) {\r\n                point.select(false);\r\n            });\r\n        }\r\n    }\r\n\r\n\r\n\r\n$(''#w_{{widget.id}}'').highcharts({\r\n            chart: {\r\n            type: ''line'',\r\n            spacingBottom: 50,\r\n            spacingTop: 50,\r\n            spacingLeft: 50,\r\n            spacingRight: 50,\r\n            events: {\r\n                selection: selectPointsByDrag,\r\n                selectedpoints: selectedPoints,\r\n                click: unselectByClick\r\n            },\r\n			zoomType: ''xy''\r\n        },\r\n        plotOptions: {\r\n            series: {\r\n                allowPointSelect: true\r\n            }\r\n        },\r\n title: {\r\n            text: ''{{parm[''chart_title'']}}''\r\n        },\r\n        		  credits: {\r\n  enabled: false\r\n  },\r\n        xAxis: {\r\n            title: {\r\n                text: ''{{parm[''x_label'']}}''\r\n            },\r\n            \r\n                {% if parm[''xtype''] == "Date" %}\r\n                type: ''datetime'',\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n                type: ''category'',\r\n                {% else %}\r\n                {% endif  %}\r\n            \r\n        },\r\n        yAxis: {\r\n            title: {\r\n                text: ''Value''\r\n            }\r\n        },\r\n        colors:{{parm[''colors'']}},\r\n series: [\r\n{% for key,series in parm[''db''] %}\r\n{\r\n     name: ''{{key|escape_js}}'',\r\n     data: [\r\n        {% for row in series %}\r\n                {% if parm[''xtype''] == "Date" %}\r\n    [Date.parse(''{{ row[''x_axis'']|escape_js }}''),{{ row[''value'']|escape_js }}] ,\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n    [''{{ row[''x_axis'']|escape_js }}'',{{ row[''value'']|escape_js }}] ,\r\n                {% else %}\r\n    [{{ row[''x_axis'']|escape_js }},{{ row[''value'']|escape_js }}] ,\r\n                {% endif  %}\r\n        {% endfor  %}\r\n]},\r\n\r\n{% endfor  %}\r\n]\r\n\r\n});\r\n\r\n$(''#preview_{{widget.id}}'').on(''click'', function(){\r\n    \r\n            var chart = $(''#w_{{widget.id}}'').highcharts(),\r\n            selectedPoints = chart.getSelectedPoints();\r\n\r\n                            var temp=[];\r\n                        $.each(selectedPoints, function (i, value) {\r\n                            temp.push(value.x);\r\n                        });\r\n                            update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n    \r\n});\r\n\r\n\r\n</script>', '', '[{"type":"database/chart"},{"type":"parameters/input","name":"x_label","label":"X Label"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"database/link_select"}]', 9, 'Basic Chart', 'Charts', 'Chart'),
(24, '<div class="col-md-{{parm[''width'']}}">\r\n<select id="w_{{widget.id}}" style="width:100%" class="input" multiple="multiple" placeholder="{{parm[''title'']}}">\r\n     {% for entry in parm[''db''] %}\r\n      <option value="{{entry[''link_column'']}}">{{entry[''values'']}}</option>\r\n    {% endfor  %}\r\n</select>\r\n</div>', '', '', '<script>\r\n\r\n$("#w_{{widget.id}}").select2();\r\n\r\n        $("#w_{{widget.id}}").change(function() {\r\n        \r\n            update_dashboard("{{parm[''target_link'']}}", $("#w_{{widget.id}}").select2("val"),{{widget.id}});\r\n  \r\n        });\r\n\r\n\r\n\r\n</script>', '', '[{"type":"parameters/select","name":"width","label":"Width","values":"1,2,3,4,5,6,7,8,9,10,11,12"},{"type":"database/single_select","name":"values","label":"Values"},{"type":"database/link_select"},{"type":"parameters/input","name":"title","label":"Title"}]', 9, 'Multi Select', 'misc', 'ByRow'),
(25, '<div>\r\n<select id="w_{{widget.id}}" style="width:100%" multiple="multiple" placeholder="{{parm[''title'']}}">\r\n     {% for entry in parm[''db''] %}\r\n      <option value="{{entry[''link_column'']}}">{{entry[''values'']}}</option>\r\n    {% endfor  %}\r\n</select>\r\n</div>', '', '', '<script>\r\n\r\n$("#w_{{widget.id}}").listbox({''searchbar'': true});\r\n\r\n        $("#w_{{widget.id}}").change(function() {\r\n        \r\n            update_dashboard("{{parm[''target_link'']}}", $("#w_{{widget.id}}").val(),{{widget.id}});\r\n  \r\n        });\r\n\r\n\r\n\r\n</script>', '', '[{"type":"database/single_select","name":"values","label":"Values"},{"type":"parameters/input","name":"title","label":"Title"},{"type":"database/link_select"}]', 9, 'Listbox', 'misc', 'ByRow'),
(27, '\r\n\r\n<div>\r\n    \r\n    <?php  $max =array();  ?>\r\n    \r\n    {% for entry in parm[''db''] %}\r\n    \r\n         <?php  $max[] = $entry[''value'']; ?>\r\n\r\n{% endfor  %}\r\n    \r\n    <?php \r\n    if(max($max)>0) \r\n    { \r\n    $max=max($max);\r\n    }\r\n    else\r\n    {\r\n    $max=1;\r\n    }\r\n    ?>\r\n    \r\n    <style>\r\n    \r\n    td {\r\n    position: relative;\r\n}\r\n.rowprogress {\r\n    position: absolute;\r\n    left: 0;\r\n    top: 0;\r\n    bottom: 0;\r\n    background-color: green;\r\n     opacity: 0.2;\r\n    z-index: 99;\r\n}\r\n</style>\r\n\r\n<table id="w_{{widget.id}}" class="table table-hover">\r\n    <thead>\r\n                          <tr>\r\n                              <th>Please Select </th>\r\n                              </tr>\r\n                        </thead>\r\n    <tbody>\r\n{% for entry in parm[''db''] %}\r\n <tr> \r\n    <td ><div class="rowprogress" style="width:{{(entry[''value'']*100) / max }}%"></div> {{entry[''label'']}} </td>\r\n </tr>\r\n{% endfor  %}\r\n</tbody>\r\n</table>\r\n</div>', '', '', '   <script>\n   var initTableWithSearch = function() {\n        var table = $(''#w_{{widget.id}}'');\n        \n <?php $linking_column=array(); ?>     \n {% for row in parm[''db''] %}\n  <?php $linking_column[]=$row[''link_column'']; ?> \n{% endfor  %}\nvar linking_column=<?php echo json_encode($linking_column) ?> ;\n\n        var settings = {\n            "sDom": ''T<"clear">lfrtip'',\n            "destroy": true,\n            "bLengthChange": false,\n            "bFilter": false,\n            "bInfo": false,\n            "scrollY": "400px",\n            "scrollX": true,\n            "paging":         false,\n                    "oTableTools": {\n            "sRowSelect": "multi",\n            "aButtons" : []\n        }\n        };\n        \n\n\n    table.dataTable(settings);\n        \n\n         $(''#w_{{widget.id}}'').on( ''click'', ''tr'', function () {\n        $(this).toggleClass(''selected'');\n            var oTT = TableTools.fnGetInstance( ''w_{{widget.id}}'' );\n    var aData = oTT.fnGetSelectedIndexes();\n    var link_set=[];\n    $.each( aData, function( key, value ) {\n    link_set.push(linking_column[value]);\n    });\n    \n    \n    \n    \n     update_dashboard("{{parm[''target_link'']}}", link_set,{{widget.id}});\n        \n    } );\n   \n    }\n    \n    initTableWithSearch();\n    \n    \n    \n    \n    </script>', '', '[{"type":"database/single_select","name":"value","label":"Values"},{"type":"database/link_select"},{"type":"database/single_select","name":"label","label":"Labels"}]', 9, 'List Menu', 'misc', 'ByRow'),
(28, '<div>\r\n<nav style="max-height:400px; overflow: auto; overflow-x: hidden;">\r\n				<ul id="w_{{widget.id}}" class="met_clean_list sf-js-enabled sf-arrows">\r\n				    \r\n				    {% for entry in parm[''db''] %}\r\n				    <li data-link="{{entry[''link_column'']}}"><a>{{entry[''value'']}}</a></li>\r\n{% endfor  %}\r\n				</ul>\r\n			</nav>\r\n			</div>', '', '', '\r\n  \r\n  <script>\r\n  $(function() {\r\n    $( "#w_{{widget.id}}" ).selectable({\r\n      stop: function() {\r\n        var link_set=[];\r\n        $( "li.ui-selected", this ).each(function() {\r\n            link_set.push($(this).data(''link''));\r\n        });\r\n        \r\n     update_dashboard("{{parm[''target_link'']}}", link_set,{{widget.id}});\r\n        \r\n        \r\n      }\r\n    });\r\n  });\r\n  </script>\r\n  \r\n', '\n<style>\n#w_{{widget.id}} .ui-selecting { background: #FECA40; }\n  #w_{{widget.id}} .ui-selected { background: #F39814; color: white; }\n</style>', '[{"type":"database/single_select","name":"value","label":"Values"},{"type":"database/link_select"}]', 9, 'Multi Menu', 'Misc', 'ByRow'),
(29, '<div id="w_{{widget.id}}" style="width:100% min-width: 600px; height: 450px; margin: 0 auto"></div>', '', '', '<?php\r\n\r\n    $dataOut=array();\r\n    foreach($parm[''db''] as $row)\r\n    {\r\n        $dataOut[$row[''grouping'']][]=array("x_axis"=>$row[''x_axis''],"value"=>$row[''y_axis'']);\r\n    }\r\n\r\n?>\r\n\r\n<script>\r\n$(''#w_{{widget.id}}'').highcharts({\r\n            chart: {\r\n            type: ''{{parm[''chart_type'']}}'',\r\n            spacingBottom: 50,\r\n            spacingTop: 50,\r\n            spacingLeft: 50,\r\n            spacingRight: 50,\r\n			zoomType: ''xy''\r\n        },\r\n title: {\r\n            text: ''{{parm[''chart_title'']}}''\r\n        },\r\n        		  credits: {\r\n  enabled: false\r\n  },\r\n        xAxis: {\r\n            title: {\r\n                text: ''{{parm[''x_label'']}}''\r\n            },\r\n            \r\n                {% if parm[''xtype''] == "Date" %}\r\n                type: ''datetime'',\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n                type: ''datetime'',\r\n                {% else %}\r\n                {% endif  %}\r\n            \r\n        },\r\n        yAxis: {\r\n            title: {\r\n                text: ''{{parm[''y_label'']}}''\r\n            }\r\n        },\r\n        colors:{{parm[''colors'']}},\r\n series: [\r\n{% for key,series in dataOut %}\r\n{\r\n     name: ''{{key|escape_js}}'',\r\n     data: [\r\n        {% for row in series %}\r\n        \r\n                {% if parm[''xtype''] == "Date" %}\r\n    [Date.parse(''{{ row[''x_axis'']|escape_js }}''),{{ row[''value'']|escape_js }}] ,\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n    [''{{ row[''x_axis'']|escape_js }}'',{{ row[''value'']|escape_js }}] ,\r\n                {% else %}\r\n    [{{ row[''x_axis'']|escape_js }},{{ row[''value'']|escape_js }}] ,\r\n                {% endif  %}\r\n        {% endfor  %}\r\n]},\r\n\r\n{% endfor  %}\r\n] \r\n\r\n});\r\n</script>', '', '[{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"parameters/select","name":"xtype","label":"X Type","values":"Date,Category,Numeric"},{"type":"database/single_select","name":"x_axis","label":"X-Axis"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"parameters/input","name":"x_label","label":"X-Label"},{"type":"parameters/input","name":"y_label","label":"Y-Label"},{"type":"parameters/select","name":"chart_type","label":"Chart Type","values":"area,bar,areaspline,bar,column,scatter,spline"},{"type":"database/single_select","name":"grouping","label":"Grouping"},{"type":"database/single_select","name":"y_axis","label":"Y-Axis"}]', 9, 'Grouped Chart', 'misc', 'ByRow');
INSERT INTO `theme_widget` (`id`, `html`, `js`, `css`, `script`, `style`, `form`, `theme_layout_id`, `name`, `category`, `data_format`) VALUES
(30, '\n<table id="w_{{widget.id}}" class="table table-hover">\n                        <thead>\n                          <tr>\n                              {% if (parm[''db'']|length !=0) %}\n                              \n                    {% for key,item in parm[''db''][0][''series''] %}\n                    <th>{{key}} </th>\n                    {% endfor  %}\n                    {% endif %}\n                          </tr>\n                        </thead>\n                        <tbody>\n                          \n                             {% for row in parm[''db''] %}\n                             <tr>\n        {% for item in row[''series''] %}\n<td class="v-align-middle">{{item}} </td>\n        {% endfor  %}\n</tr>\n{% endfor  %}\n                        </tbody>\n                      </table>\n                      ', '', '', '   <script>\n   var initTableWithSearch = function() {\n        var table = $(''#w_{{widget.id}}'');\n        \n <?php $linking_column=array(); ?>     \n {% for row in parm[''db''] %}\n  <?php $linking_column[]=$row[''link_column'']; ?> \n{% endfor  %}\nvar linking_column=<?php echo json_encode($linking_column) ?> ;\n\n        var settings = {\n            "sDom": ''T<"clear">lfrtip'',\n            "destroy": true,\n            "bLengthChange": false,\n            "bFilter": false,\n            "bInfo": false,\n            "scrollX": true,\n            "responsive": true,\n            "scrollCollapse": true,\n            "paging":         true,\n                    "oTableTools": {\n            "sRowSelect": "multi",\n            "aButtons" : []\n        }\n        };\n        \n\n\n    table.dataTable(settings);\n        \n\n         $(''#w_{{widget.id}} tbody'').on( ''click'', ''tr'', function () {\n        $(this).toggleClass(''selected'');\n            var oTT = TableTools.fnGetInstance( ''w_{{widget.id}}'' );\n    var aData = oTT.fnGetSelectedIndexes();\n    var link_set=[];\n    $.each( aData, function( key, value ) {\n    link_set.push(linking_column[value]);\n    });\n    \n    \n    \n    \n     update_dashboard("{{parm[''target_link'']}}", link_set,{{widget.id}});\n        \n    } );\n   \n    }\n    \n    initTableWithSearch();\n    \n    \n    \n    \n    </script>', '', '[{"type":"database/multi_select","name":"series","label":"Table Columns"},{"type":"database/link_select"}]', 2, 'Spline Chart', 'Tables', 'ByRow'),
(31, '\n<div id="w_{{widget.id}}" style="width:100% min-width: 600px; height: 450px; margin: 0 auto"></div>\n', '', '', '<script>\r\n\r\n\r\n    function selectPointsByDrag(e) {\r\n\r\n        // Select points\r\n        Highcharts.each(this.series, function (series) {\r\n            Highcharts.each(series.points, function (point) {\r\n                if (point.x >= e.xAxis[0].min && point.x <= e.xAxis[0].max &&\r\n                        point.y >= e.yAxis[0].min && point.y <= e.yAxis[0].max) {\r\n                    point.select(true, true);\r\n                }\r\n            });\r\n        });\r\n\r\n        // Fire a custom event\r\n        HighchartsAdapter.fireEvent(this, ''selectedpoints'', { points: this.getSelectedPoints() });\r\n\r\n        return false; // Don''t zoom\r\n    }\r\n\r\n    /**\r\n     * The handler for a custom event, fired from selection event\r\n     */\r\n    function selectedPoints(e) {\r\n        var temp=[];\r\n                        $.each(e.points, function (i, value) {\r\n                            \r\n                {% if parm[''xtype''] == "Date" %}\r\n                temp.push(value.x);\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n                 temp.push(value.name);\r\n                {% else %}\r\n                 temp.push(value.x);\r\n                {% endif  %}\r\n                            \r\n                            \r\n                            \r\n                            \r\n                           \r\n                        });\r\n                            update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n\r\n    }\r\n\r\n    /**\r\n     * On click, unselect all points\r\n     */\r\n    function unselectByClick() {\r\n        var points = this.getSelectedPoints();\r\n        if (points.length > 0) {\r\n            Highcharts.each(points, function (point) {\r\n                point.select(false);\r\n            });\r\n        }\r\n    }\r\n\r\n\r\n\r\n$(''#w_{{widget.id}}'').highcharts({\r\n            chart: {\r\n            type: ''bar'',\r\n            spacingBottom: 50,\r\n            spacingTop: 50,\r\n            spacingLeft: 50,\r\n            spacingRight: 50,\r\n            events: {\r\n                selection: selectPointsByDrag,\r\n                selectedpoints: selectedPoints,\r\n                click: unselectByClick\r\n            },\r\n			zoomType: ''xy''\r\n        },\r\n        plotOptions: {\r\n            series: {\r\n                allowPointSelect: true\r\n            }\r\n        },\r\n title: {\r\n            text: ''{{parm[''chart_title'']}}''\r\n        },\r\n        		  credits: {\r\n  enabled: false\r\n  },\r\n        xAxis: {\r\n            title: {\r\n                text: ''{{parm[''x_label'']}}''\r\n            },\r\n            \r\n                {% if parm[''xtype''] == "Date" %}\r\n                type: ''datetime'',\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n                type: ''category'',\r\n                {% else %}\r\n                {% endif  %}\r\n            \r\n        },\r\n        yAxis: {\r\n            title: {\r\n                text: ''Value''\r\n            }\r\n        },\r\n        colors:{{parm[''colors'']}},\r\n series: [\r\n{% for key,series in parm[''db''] %}\r\n{\r\n     name: ''{{key|escape_js}}'',\r\n     data: [\r\n        {% for row in series %}\r\n                {% if parm[''xtype''] == "Date" %}\r\n    [Date.parse(''{{ row[''x_axis'']|escape_js }}''),{{ row[''value'']|escape_js }}] ,\r\n                {% elseif parm[''xtype''] == "Category" %}\r\n    [''{{ row[''x_axis'']|escape_js }}'',{{ row[''value'']|escape_js }}] ,\r\n                {% else %}\r\n    [{{ row[''x_axis'']|escape_js }},{{ row[''value'']|escape_js }}] ,\r\n                {% endif  %}\r\n        {% endfor  %}\r\n]},\r\n\r\n{% endfor  %}\r\n]\r\n\r\n});\r\n\r\n$(''#preview_{{widget.id}}'').on(''click'', function(){\r\n    \r\n            var chart = $(''#w_{{widget.id}}'').highcharts(),\r\n            selectedPoints = chart.getSelectedPoints();\r\n\r\n                            var temp=[];\r\n                        $.each(selectedPoints, function (i, value) {\r\n                            temp.push(value.x);\r\n                        });\r\n                            update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n    \r\n});\r\n\r\n\r\n</script>', '', '[{"type":"database/chart"},{"type":"parameters/input","name":"x_label","label":"X Label"},{"type":"parameters/select","name":"xtype","label":"X-Axis Type","values":"Date,Category,Numeric"},{"type":"parameters/color_select","name":"colors","label":"Chart Color Scheme:"},{"type":"database/link_select"}]', 2, 'Bar Chart', 'Charts', 'Chart'),
(32, '<div id="w_{{widget.id}}" style="width:100% min-width: 600px; height: 500px; margin: 0 auto"></div>', '', '', '\r\n<script>\r\nw{{widget.id}}_selectedPoints = [];\r\n$(''#w_{{widget.id}}'').highcharts({\r\n            chart: {\r\n            type: ''funnel'',\r\n            spacingBottom: 50,\r\n            spacingTop: 50,\r\n            spacingLeft: 50,\r\n            spacingRight: 50,\r\n			zoomType: ''xy''\r\n        },\r\n           plotOptions: {\r\n        series: {\r\n            allowPointSelect: true,\r\n            point: {\r\n                events: {\r\n                    select: function (event) {\r\n                        var chart = this.series.chart;\r\n                        if (event.accumulate) {\r\n                            w{{widget.id}}_selectedPoints.push(this);\r\n                        } else {\r\n                            w{{widget.id}}_selectedPoints = [this];\r\n                        }\r\n                        var temp=[];\r\n                        $.each(w{{widget.id}}_selectedPoints, function (i, value) {\r\n                            temp.push(value.name);\r\n                        });\r\n                        \r\n                             update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n                    },\r\n                    unselect: function (event) {\r\n                        var index = w{{widget.id}}_selectedPoints.indexOf(this);\r\n                        if (index > -1) {\r\n                            w{{widget.id}}_selectedPoints.splice(index, 1);\r\n                            var temp=[];\r\n                        $.each(w{{widget.id}}_selectedPoints, function (i, value) {\r\n                            temp.push(value.name);\r\n                        });\r\n                            update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n                        }\r\n                        \r\n                    }\r\n                }\r\n            }\r\n        }\r\n    },\r\n title: {\r\n            text: ''{{parm[''chart_title'']}}''\r\n        },\r\n        		  credits: {\r\n  enabled: false\r\n  },\r\n    colors:{{parm[''colors'']}},\r\n  series: [{\r\n     data: [\r\n{% for row in parm[''db''] %}\r\n{\r\n     name: ''{{ row[''label'']|escape_js }}'',\r\n     y: {{ row[''value'']|escape_js }}\r\n},\r\n{% endfor  %}\r\n]}]\r\n});\r\n</script>', '', '[{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"database/single_select","name":"label","label":"Label"},{"type":"database/single_select","name":"value","label":"Value"},{"type":"database/link_select"}]', 2, 'Funnel chart', 'Charts', 'ByRow'),
(33, '<div id="w_{{widget.id}}" style="width:100% min-width: 600px; height: 500px; margin: 0 auto"></div>', '', '', '\r\n<script>\r\nw{{widget.id}}_selectedPoints = [];\r\n$(''#w_{{widget.id}}'').highcharts({\r\n            chart: {\r\n            type: ''pie'',\r\n            spacingBottom: 50,\r\n            spacingTop: 50,\r\n            spacingLeft: 50,\r\n            spacingRight: 50,\r\n			zoomType: ''xy''\r\n        },\r\n           plotOptions: {\r\n        series: {\r\n            allowPointSelect: true,\r\n            point: {\r\n                events: {\r\n                    select: function (event) {\r\n                        var chart = this.series.chart;\r\n                        if (event.accumulate) {\r\n                            w{{widget.id}}_selectedPoints.push(this);\r\n                        } else {\r\n                            w{{widget.id}}_selectedPoints = [this];\r\n                        }\r\n                        var temp=[];\r\n                        $.each(w{{widget.id}}_selectedPoints, function (i, value) {\r\n                            temp.push(value.name);\r\n                        });\r\n                        \r\n                             update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n                    },\r\n                    unselect: function (event) {\r\n                        var index = w{{widget.id}}_selectedPoints.indexOf(this);\r\n                        if (index > -1) {\r\n                            w{{widget.id}}_selectedPoints.splice(index, 1);\r\n                            var temp=[];\r\n                        $.each(w{{widget.id}}_selectedPoints, function (i, value) {\r\n                            temp.push(value.name);\r\n                        });\r\n                            update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n                        }\r\n                        \r\n                    }\r\n                }\r\n            }\r\n        }\r\n    },\r\n title: {\r\n            text: ''{{parm[''chart_title'']}}''\r\n        },\r\n        		  credits: {\r\n  enabled: false\r\n  },\r\n    colors:{{parm[''colors'']}},\r\n  series: [{\r\n     data: [\r\n{% for row in parm[''db''] %}\r\n{\r\n     name: ''{{ row[''label'']|escape_js }}'',\r\n     y: {{ row[''value'']|escape_js }}\r\n},\r\n{% endfor  %}\r\n]}]\r\n});\r\n</script>', '', '[{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"database/single_select","name":"label","label":"Label"},{"type":"database/link_select"},{"type":"database/single_select","name":"value","label":"Value"}]', 2, 'Pie Chart', 'Charts', 'ByRow'),
(34, '<div id="w_{{widget.id}}" style="width:100% min-width: 600px; height: 500px; margin: 0 auto"></div>', '', '', '\r\n<script>\r\nw{{widget.id}}_selectedPoints = [];\r\n$(''#w_{{widget.id}}'').highcharts({\r\n            chart: {\r\n            type: ''pyramid'',\r\n            spacingBottom: 50,\r\n            spacingTop: 50,\r\n            spacingLeft: 50,\r\n            spacingRight: 50,\r\n			zoomType: ''xy''\r\n        },\r\n           plotOptions: {\r\n        series: {\r\n            allowPointSelect: true,\r\n            point: {\r\n                events: {\r\n                    select: function (event) {\r\n                        var chart = this.series.chart;\r\n                        if (event.accumulate) {\r\n                            w{{widget.id}}_selectedPoints.push(this);\r\n                        } else {\r\n                            w{{widget.id}}_selectedPoints = [this];\r\n                        }\r\n                        var temp=[];\r\n                        $.each(w{{widget.id}}_selectedPoints, function (i, value) {\r\n                            temp.push(value.name);\r\n                        });\r\n                        \r\n                             update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n                    },\r\n                    unselect: function (event) {\r\n                        var index = w{{widget.id}}_selectedPoints.indexOf(this);\r\n                        if (index > -1) {\r\n                            w{{widget.id}}_selectedPoints.splice(index, 1);\r\n                            var temp=[];\r\n                        $.each(w{{widget.id}}_selectedPoints, function (i, value) {\r\n                            temp.push(value.name);\r\n                        });\r\n                            update_dashboard("{{parm[''target_link'']}}", temp,{{widget.id}});\r\n                        }\r\n                        \r\n                    }\r\n                }\r\n            }\r\n        }\r\n    },\r\n title: {\r\n            text: ''{{parm[''chart_title'']}}''\r\n        },\r\n        		  credits: {\r\n  enabled: false\r\n  },\r\n    colors:{{parm[''colors'']}},\r\n  series: [{\r\n     data: [\r\n{% for row in parm[''db''] %}\r\n{\r\n     name: ''{{ row[''label'']|escape_js }}'',\r\n     y: {{ row[''value'']|escape_js }}\r\n},\r\n{% endfor  %}\r\n]}]\r\n});\r\n</script>', '', '[{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"database/single_select","name":"label","label":"Label"},{"type":"database/link_select"},{"type":"database/single_select","name":"value","label":"Value"}]', 2, 'Pyramid Chart', 'Charts', 'ByRow');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(40) NOT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `parameters` varchar(2000) DEFAULT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `role` enum('Admin','Supervisor','User') NOT NULL DEFAULT 'Admin',
  `status` enum('enable','disable') DEFAULT 'disable',
  `organisation_id` int(10) unsigned NOT NULL,
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `full_name`, `parameters`, `image_path`, `password`, `role`, `status`, `organisation_id`, `registration_date`, `last_login`) VALUES
('15745090@sun.ac.za', 'Christopher Willemse', NULL, NULL, 'b94f3b709a3dab22e512b551ed4dbe7c59911ccc', 'Admin', 'disable', 2, '2015-10-01 18:17:38', NULL),
('calvin@primeanalytics.io', 'Calvin Maree', NULL, '/assets/global/images/avatars/avatar11_big@2x.png', '8cb2237d0679ca88db6464eac60da96345513964', 'Admin', 'enable', 1, '2015-11-11 12:00:10', NULL),
('christopher@primeanalytics.io', 'Christopher', NULL, '/assets/global/images/avatars/avatar11_big@2x.png', '8cb2237d0679ca88db6464eac60da96345513964', 'User', 'enable', 1, '2015-11-10 23:24:50', NULL),
('cloudcalvin@me.com', 'Calvin Maree', NULL, NULL, '8cb2237d0679ca88db6464eac60da96345513964', 'Admin', 'disable', 3, '2015-11-11 14:36:09', NULL),
('enricowillemse.was@gmail.com', 'John Doe', NULL, NULL, '4cec04d3fffe952728e63871e875e5bc0c5dda7c', 'Admin', 'disable', 4, '2015-11-14 21:17:47', NULL),
('support@primeanalytics.io', 'Enrico Willemse', NULL, '/assets/global/images/avatars/avatar11_big@2x.png', '4cec04d3fffe952728e63871e875e5bc0c5dda7c', 'Admin', 'enable', 1, '2015-09-15 20:34:14', NULL),
('test@primeanalytics.io', 'Emile Naude', NULL, '/assets/global/images/avatars/avatar11_big@2x.png', '8cb2237d0679ca88db6464eac60da96345513964', 'User', 'enable', 1, '2015-10-22 23:36:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(10) unsigned NOT NULL,
  `type` varchar(45) NOT NULL,
  `column` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `parameters` varchar(2000) DEFAULT NULL,
  `portlet_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `type`, `column`, `row`, `parameters`, `portlet_id`) VALUES
(111, 'tables/basic_table', 0, 0, '{"width":"col-md-12","db":{"table":"13","series":["placement_name","clicks"],"link_column":"placement_name"},"target_link":"7"}', 27),
(112, 'charts/pie_chart', 0, 0, '{"width":"col-md-12","db":{"table":"14","label":"country_name","link_column":"country_name","value":"clicks"},"target_link":"8","colors":"[\\"#D0C91F\\",\\"#85C4B9\\",\\"#008BBA\\",\\"#DF514C\\",\\"#DC403B\\"]","chart_title":""}', 28),
(113, 'morris/donut_chart', 0, 0, '{"width":"col-md-12","title":"","db":{"table":"16","value":"clicks","label":"site_name","link_column":"site_name"},"target_link":"9"}', 29),
(114, 'morris/donut_chart', 0, 0, '{"width":"col-md-12","title":"","db":{"table":"15","value":"clicks","label":"placement_size","link_column":"placement_size"},"target_link":"10"}', 30),
(115, 'charts/line_chart', 0, 0, '{"width":"col-md-12","db":{"table":"11","x_axis":"date","series":["clicks"],"link_column":"date"},"chart_title":"","x_label":"Date","y_label":"Clicks","chart_type":"area","colors":"[\\"#69D2E7\\",\\"#A7DBDB\\",\\"#E0E4CC\\",\\"#F38630\\",\\"#FA6900\\"]","target_link":"11","xtype":"Date"}', 31),
(116, 'morris/donut_chart', 0, 0, '{"width":"col-md-3","title":"Advertiser","db":{"table":"10","value":"clicks","label":"advertiser_name","link_column":"advertiser_name"},"target_link":"5"}', 32),
(117, 'morris/donut_chart', 1, 0, '{"width":"col-md-3","title":"Campaigns","db":{"table":"12","value":"clicks","label":"campaign_name","link_column":"campaign_name"},"target_link":"6"}', 32),
(118, 'morris/donut_chart', 2, 0, '{"width":"col-md-3","title":"Placement Size","db":{"table":"15","value":"clicks","label":"placement_size","link_column":"placement_size"},"target_link":"10"}', 32),
(119, 'morris/donut_chart', 3, 0, '{"width":"col-md-3","title":"Site Name","db":{"table":"16","value":"clicks","label":"site_name","link_column":"site_name"},"target_link":"9"}', 32),
(120, 'charts/pie_chart', 0, 0, '{"width":"col-md-12","db":{"table":"14","label":"country_name","link_column":"country_name","value":"clicks"},"target_link":"8","colors":"[\\"#B1EB00\\",\\"#53BBF4\\",\\"#FF85CB\\",\\"#FF432E\\",\\"#FFAC00\\"]","chart_title":""}', 33),
(121, 'charts/line_chart', 0, 0, '{"width":"col-md-12","db":{"table":"11","x_axis":"date","series":["clicks"],"link_column":"date"},"chart_title":"","x_label":"Date","y_label":"Clicks","chart_type":"spline","colors":"[\\"#B1EB00\\",\\"#53BBF4\\",\\"#FF85CB\\",\\"#FF432E\\",\\"#FFAC00\\"]","target_link":"11","xtype":"Date"}', 34),
(122, 'tables/basic_table', 0, 0, '{"width":"col-md-12","db":{"table":"13","series":["placement_name","revenue","clicks","impressions","planned cost"],"link_column":"placement_name"},"target_link":"7"}', 35),
(127, 'charts/line_chart', 0, 0, '{"width":"col-md-12","db":{"table":"17","x_axis":"date","series":["sum(sales_quantity)"],"link_column":"date"},"chart_title":"","x_label":"","y_label":"","chart_type":"column","colors":"[\\"#DB3340\\",\\"#E8B71A\\",\\"#F7EAC8\\",\\"#1FDA9A\\",\\"#28ABE3\\"]","target_link":"11","xtype":"Date"}', 36),
(134, 'misc/list_menu', 0, 0, '{"width":"col-md-12","db":{"table":"14","value":"clicks","link_column":"country_name","label":"country_name"},"target_link":"8"}', 41),
(136, 'misc/multi_menu', 0, 0, '{"width":"col-md-12","db":{"table":"12","value":"campaign_name","link_column":"campaign_name"},"target_link":"6"}', 44),
(138, 'charts/basic_chart', 0, 0, '{"width":"col-md-12","db":{"table":"11","x_axis":"date","series":["impressions"],"link_column":"date"},"chart_title":"","x_label":"","y_label":"","chart_type":"area","colors":"[\\"#B1EB00\\",\\"#53BBF4\\",\\"#FF85CB\\",\\"#FF432E\\",\\"#FFAC00\\"]","target_link":"11","xtype":"Date"}', 45),
(139, 'tables/basic_table', 0, 0, '{"width":"col-md-12","db":{"table":"10","series":["advertiser_name","revenue","clicks","impressions","planned cost"],"link_column":"advertiser_name"},"target_link":"5"}', 47),
(140, 'tables/basic_table', 0, 1, '{"width":"col-md-12","db":{"table":"14","series":["country_name","revenue","clicks","impressions","planned cost"],"link_column":"country_name"},"target_link":"8"}', 47),
(141, 'charts/basic_chart', 0, 2, '{"width":"col-md-12","db":{"table":"10","x_axis":"advertiser_name","series":["revenue,clicks,impressions,planned cost"],"link_column":"advertiser_name"},"chart_title":"","x_label":"Advertiser","xtype":"Category","colors":"[\\"#B1EB00\\",\\"#53BBF4\\",\\"#FF85CB\\",\\"#FF432E\\",\\"#FFAC00\\"]","target_link":"5"}', 47),
(143, 'charts/bar_chart', 0, 0, '{"width":"col-md-12","db":{"table":"11","x_axis":"date","series":["impressions"],"link_column":"date"},"chart_title":"overview","x_label":"Date","xtype":"Date","colors":"[\\"#D0C91F\\",\\"#85C4B9\\",\\"#008BBA\\",\\"#DF514C\\",\\"#DC403B\\"]","target_link":"11"}', 48),
(144, 'charts/funnel_chart', 0, 1, '{"width":"col-md-4","db":{"table":"10","label":"advertiser_name","link_column":"advertiser_name","value":"impressions"},"target_link":"5","colors":"[\\"#B1EB00\\",\\"#53BBF4\\",\\"#FF85CB\\",\\"#FF432E\\",\\"#FFAC00\\"]","chart_title":"Advertisers"}', 48),
(145, 'charts/pyramid_chart', 1, 1, '{"width":"col-md-8","chart_title":"Campaigns","colors":"[\\"#0B99BC\\",\\"#5C2D50\\",\\"#D40E52\\",\\"#CD1719\\",\\"#FCE014\\"]","db":{"table":"12","label":"campaign_name","link_column":"campaign_name","value":"revenue"},"target_link":"6"}', 48);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dashboard_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `dashboard_has_users`
--
ALTER TABLE `dashboard_has_users`
  ADD PRIMARY KEY (`dashboard_id`,`users_email`),
  ADD KEY `fk_dashboard_has_users_users1_idx` (`users_email`),
  ADD KEY `fk_dashboard_has_users_dashboard1_idx` (`dashboard_id`);

--
-- Indexes for table `data_connector`
--
ALTER TABLE `data_connector`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_connector_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_links_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_login_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `org_database`
--
ALTER TABLE `org_database`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_database_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_method_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `physical_address`
--
ALTER TABLE `physical_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_physical_address_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `portlet`
--
ALTER TABLE `portlet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_canvas_dashboard1_idx` (`dashboard_id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_process_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `process_operator`
--
ALTER TABLE `process_operator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_process_operator_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `process_scheduled`
--
ALTER TABLE `process_scheduled`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_process_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `theme_dashboard`
--
ALTER TABLE `theme_dashboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_theme_dashboard_theme_layout1_idx` (`theme_layout_id`);

--
-- Indexes for table `theme_layout`
--
ALTER TABLE `theme_layout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_login`
--
ALTER TABLE `theme_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_theme_login_theme_layout1_idx` (`theme_layout_id`);

--
-- Indexes for table `theme_portlet`
--
ALTER TABLE `theme_portlet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_theme_portlet_theme_layout1_idx` (`theme_layout_id`);

--
-- Indexes for table `theme_widget`
--
ALTER TABLE `theme_widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_theme_widget_theme_layout1_idx` (`theme_layout_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `fk_users_organisation1_idx` (`organisation_id`);

--
-- Indexes for table `widget`
--
ALTER TABLE `widget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_widget_portlet1_idx` (`portlet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `data_connector`
--
ALTER TABLE `data_connector`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `org_database`
--
ALTER TABLE `org_database`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `physical_address`
--
ALTER TABLE `physical_address`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `portlet`
--
ALTER TABLE `portlet`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `process_operator`
--
ALTER TABLE `process_operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `process_scheduled`
--
ALTER TABLE `process_scheduled`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `theme_dashboard`
--
ALTER TABLE `theme_dashboard`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `theme_layout`
--
ALTER TABLE `theme_layout`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `theme_login`
--
ALTER TABLE `theme_login`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `theme_portlet`
--
ALTER TABLE `theme_portlet`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `theme_widget`
--
ALTER TABLE `theme_widget`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD CONSTRAINT `fk_dashboard_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dashboard_has_users`
--
ALTER TABLE `dashboard_has_users`
  ADD CONSTRAINT `fk_dashboard_has_users_dashboard1` FOREIGN KEY (`dashboard_id`) REFERENCES `dashboard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dashboard_has_users_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `data_connector`
--
ALTER TABLE `data_connector`
  ADD CONSTRAINT `fk_connector_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `fk_links_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_login_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `org_database`
--
ALTER TABLE `org_database`
  ADD CONSTRAINT `fk_database_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `fk_payment_method_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `physical_address`
--
ALTER TABLE `physical_address`
  ADD CONSTRAINT `fk_physical_address_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `portlet`
--
ALTER TABLE `portlet`
  ADD CONSTRAINT `fk_canvas_dashboard1` FOREIGN KEY (`dashboard_id`) REFERENCES `dashboard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `process`
--
ALTER TABLE `process`
  ADD CONSTRAINT `fk_process_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `process_operator`
--
ALTER TABLE `process_operator`
  ADD CONSTRAINT `fk_process_operator_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `process_scheduled`
--
ALTER TABLE `process_scheduled`
  ADD CONSTRAINT `fk_process_organisation10` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `theme_dashboard`
--
ALTER TABLE `theme_dashboard`
  ADD CONSTRAINT `fk_theme_dashboard_theme_layout1` FOREIGN KEY (`theme_layout_id`) REFERENCES `theme_layout` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `theme_login`
--
ALTER TABLE `theme_login`
  ADD CONSTRAINT `fk_theme_login_theme_layout1` FOREIGN KEY (`theme_layout_id`) REFERENCES `theme_layout` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `theme_portlet`
--
ALTER TABLE `theme_portlet`
  ADD CONSTRAINT `fk_theme_portlet_theme_layout1` FOREIGN KEY (`theme_layout_id`) REFERENCES `theme_layout` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `theme_widget`
--
ALTER TABLE `theme_widget`
  ADD CONSTRAINT `fk_theme_widget_theme_layout1` FOREIGN KEY (`theme_layout_id`) REFERENCES `theme_layout` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `widget`
--
ALTER TABLE `widget`
  ADD CONSTRAINT `fk_widget_portlet1` FOREIGN KEY (`portlet_id`) REFERENCES `portlet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Database: `test`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
