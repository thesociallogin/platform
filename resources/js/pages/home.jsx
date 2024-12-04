import { BentoCard } from '@/components/bento-card.jsx'
import { Container } from '@/components/container.jsx'
import Features from '@/components/features.jsx'
import { Footer } from '@/components/footer.jsx'
import Hero from '@/components/hero.jsx'
import { Keyboard } from '@/components/keyboard.jsx'
import { LinkedAvatars } from '@/components/linked-avatars.jsx'
import { LogoCloud } from '@/components/logo-cloud.jsx'
import { LogoCluster } from '@/components/logo-cluster.jsx'
import { LogoTimeline } from '@/components/logo-timeline.jsx'
import { Map } from '@/components/map.jsx'
import { Testimonials } from '@/components/testimonials.jsx'
import { Heading, Subheading } from '@/components/text.jsx'

function BentoSection() {
  return (
    <Container>
      <Subheading>Workflow</Subheading>
      <Heading as='h3' className='mt-2 max-w-3xl'>
        Configure your authentication once.
      </Heading>

      <div className='mt-10 grid grid-cols-1 gap-4 sm:mt-16 lg:grid-cols-6 lg:grid-rows-2'>
        <BentoCard
          eyebrow='Connection'
          title='Connect your app'
          description='Connect your app using one of your supported plugins or libraries. Setup your own custom connection using our API or SDKs. No confusing terminology. Just point and click connections.'
          graphic={<div className='h-80 bg-[url(/images/connection.png)] bg-no-repeat' />}
          fade={['bottom']}
          className='max-lg:rounded-t-4xl lg:col-span-3 lg:rounded-tl-4xl'
        />
        <BentoCard
          eyebrow='Provider'
          title='Define your providers'
          description='Choose from a range of supported Identity Providers such as Facebook, Google, Discord, or add your own custom provider. Configure and build your providers on a per-connection/app basis.'
          graphic={<div className='absolute inset-0 bg-[url(/images/provider.png)] bg-no-repeat' />}
          fade={['bottom']}
          className='lg:col-span-3 lg:rounded-tr-4xl'
        />
        <BentoCard
          eyebrow='Single Sign-On'
          title='Log your users in'
          description='Use The Social Login as a central SSO identity provider or configure your connection/app to allow users to login using one of the pre-configured providers.'
          graphic={
            <div className='flex size-full pl-10 pt-10'>
              <Keyboard highlighted={['LeftCommand', 'LeftShift', 'D']} />
            </div>
          }
          className='lg:col-span-2 lg:rounded-bl-4xl'
        />
        <BentoCard
          eyebrow='Administration'
          title='Manage your users'
          description='Access easy-to-use field mapping and user administration. Connect your apps and establish a singluar identity for all your users.'
          graphic={<LogoCluster />}
          className='lg:col-span-2'
        />
        <BentoCard
          eyebrow='Pricing'
          title='Understandable pricing'
          description='No custom pricing models or hidden fees. Subscribe using a base monthly fee and access every feature The Social Login has.'
          graphic={<Map />}
          className='max-lg:rounded-b-4xl lg:col-span-2 lg:rounded-br-4xl'
        />
      </div>
    </Container>
  )
}

function DarkBentoSection() {
  return (
    <div className='mx-2 rounded-4xl bg-zinc-900 py-32'>
      <Container>
        <Subheading dark>Integration</Subheading>
        <Heading as='h3' dark className='mt-2 max-w-3xl'>
          Built for developers, by developers.
        </Heading>

        <div className='mt-10 grid grid-cols-1 gap-4 sm:mt-16 lg:grid-cols-6 lg:grid-rows-2'>
          <BentoCard
            dark
            eyebrow='Plugins and Libraries'
            title='Sell at the speed of light'
            description='Choose from one of our supported plugins or libraries from some of the most popular solutions such as Wordpress, Shopify, or integrate with a framework such as Laravel or React.'
            graphic={<div className='h-80 bg-[url(/screenshots/networking.png)] bg-[size:851px_344px] bg-no-repeat' />}
            fade={['top']}
            className='max-lg:rounded-t-4xl lg:col-span-4 lg:rounded-tl-4xl'
          />
          <BentoCard
            dark
            eyebrow='Integrations'
            title='Preconfigured providers'
            description='The Social Login comes with a host of pre-confgiured identity providers such as Google, Facebook or Discord.'
            graphic={<LogoTimeline />}
            // `!overflow-visible` is needed to work around a Chrome bug that disables the mask on the graphic.
            className='z-10 !overflow-visible lg:col-span-2 lg:rounded-tr-4xl'
          />
          <BentoCard
            dark
            eyebrow='API'
            title='Authentication as a service'
            description='Integrate with The Social Login using our powerful API. Get access to a suite of authentication tools at your fingertips.'
            graphic={<LinkedAvatars />}
            className='lg:col-span-2 lg:rounded-bl-4xl'
          />
          <BentoCard
            dark
            eyebrow='Open Source'
            title='Giving back to the community'
            description='The Social Login is a fully open-source project that aims to provide authentication services that support an improved developer and user experience while providing custom and flexible solutions.'
            graphic={<div className='h-80 bg-[url(/screenshots/engagement.png)] bg-[size:851px_344px] bg-no-repeat' />}
            fade={['top']}
            className='max-lg:rounded-b-4xl lg:col-span-4 lg:rounded-br-4xl'
          />
        </div>
      </Container>
    </div>
  )
}

export default function Home() {
  return (
    <div className='overflow-hidden'>
      <Hero />
      <main>
        <section className='mt-10' id='providers'>
          <Container>
            <LogoCloud />
          </Container>
        </section>
        <section className='bg-gradient-to-b from-white from-50% to-zinc-100 py-32' id='features'>
          <Features />
          <BentoSection />
        </section>
        <section className='bg-zinc-100' id='developers'>
          <DarkBentoSection />
        </section>
        <section className='bg-gradient-to-b from-zinc-100 from-50% to-white' id='testimonials'>
          <Testimonials />
        </section>
      </main>
      <Footer />
    </div>
  )
}
